@extends('layouts.main')

@section('main')
    <style>
        #video-container {
            line-height: 0;
        }

        #video-container.example-style-1 .scan-region-highlight-svg,
        #video-container.example-style-1 .code-outline-highlight {
            stroke: #64a2f3 !important;
        }

        #video-container.example-style-2 {
            position: relative;
            width: max-content;
            height: max-content;
            overflow: hidden;
        }

        #video-container.example-style-2 .scan-region-highlight {
            border-radius: 30px;
            outline: rgba(0, 0, 0, .25) solid 50vmax;
        }

        #video-container.example-style-2 .scan-region-highlight-svg {
            display: none;
        }

        #video-container.example-style-2 .code-outline-highlight {
            stroke: rgba(255, 255, 255, .5) !important;
            stroke-width: 15 !important;
            stroke-dasharray: none !important;
        }

        #flash-toggle {
            display: none;
        }

    </style>
    <h3 class="mb-4">QR Scanner</h3>
    <div class="row">
        <div class="col-lg-6 mb-3">
            <div id="video-container">
                <video id="qr-video" width="100%"></video>
            </div>
            <div class="py-3 rounded-lg border text-center" id="resultInfo" style="display: none;"></div>
        </div>
        <div class="col-lg-6 mb-3">
            <div class="mb-3">
                <label class="form-label">Highlight</label>
                <select class="form-control" id="scan-region-highlight-style-select">
                    <option value="default-style">Default style</option>
                    <option value="example-style-1">Custom style 1</option>
                    <option value="example-style-2">Custom style 2</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Scan Mode</label>
                <select class="form-control" id="inversion-mode-select">
                    <option value="original">Scan original (dark QR code on bright background)</option>
                    <option value="invert">Scan with inverted colors (bright QR code on dark background)</option>
                    <option value="both">Scan both</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-label">Camera Availibility: <span class="badge bg-primary" id="cam-has-camera"></span>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Perefered Camera</label>
                <select class="form-control" id="cam-list">
                    <option value="environment" selected>Environment Facing (default)</option>
                    <option value="user">User Facing</option>
                </select>
            </div>
            <div class="mb-3">
                <div class="form-label">Camera Flash: <span class="badge bg-primary" id="cam-has-flash"></span>
                </div>
                <button class="btn btn-sm btn-primary" id="flash-toggle">📸 Flash: <span
                        id="flash-state">off</span></button>
            </div>
            <div class="mb-3">
                <div class="form-label">Last Detected QR Code: <span class="badge bg-primary"
                        id="cam-qr-result-timestamp"></span>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-label">Result: <span class="badge bg-light" id="cam-qr-result"></span>
                </div>
            </div>
            <div class="text-end">
                <button class="btn btn-dark btn-sm" id="start-button">Start</button>
                <button class="btn btn-dark btn-sm" id="stop-button">Stop</button>
                <button class="btn btn-dark btn-sm" id="destroy-button">Destroy Scanner</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="module">
        import QrScanner from "{{ asset('js/qr-scanner.min.js') }}"

        function playBeep() {
            var audio = new Audio("{{ asset('sound/beep-07a.mp3') }}").play()
        }

        let video = document.getElementById('qr-video')
        let videoContainer = document.getElementById('video-container')
        let camHasCamera = document.getElementById('cam-has-camera')
        let camList = document.getElementById('cam-list')
        let camHasFlash = document.getElementById('cam-has-flash')
        let flashToggle = document.getElementById('flash-toggle')
        let flashState = document.getElementById('flash-state')
        let camQrResult = document.getElementById('cam-qr-result')
        let camQrResultTimestamp = document.getElementById('cam-qr-result-timestamp')
        let resultInfo = document.getElementById('resultInfo')


        function setResult(label, result) {
            playBeep()
            scanner.stop()
            videoContainer.style.display = 'none'
            resultInfo.style.display = 'block'
            resultInfo.innerHTML = 'Memproses...'
            setTimeout(() => {
                processFill(result)
            }, 2000)
            label.textContent = result.data
            camQrResultTimestamp.textContent = new Date().toString()
            label.style.color = 'teal'
            clearTimeout(label.highlightTimeout)
            label.highlightTimeout = setTimeout(() => label.style.color = 'inherit', 100)
        }

        // ####### Web Cam Scanning #######

        let scanner = new QrScanner(
            video,
            result => setResult(camQrResult, result), {
                onDecodeError: error => {
                    camQrResult.textContent = error
                    camQrResult.style.color = 'inherit'
                },
                highlightScanRegion: true,
                highlightCodeOutline: true,
            }, {
                maxScansPerSecond: 1
            }
        )

        let updateFlashAvailability = () => {
            scanner.hasFlash().then(hasFlash => {
                camHasFlash.textContent = hasFlash
                flashToggle.style.display = hasFlash ? 'inline-block' : 'none'
            })
        }

        scanner.start().then(() => {
            updateFlashAvailability()
            // List cameras after the scanner started to avoid listCamera's stream and the scanner's stream being requested
            // at the same time which can result in listCamera's unletrained stream also being offered to the scanner.
            // Note that we can also start the scanner after listCameras, we just have it this way around in the demo to
            // start the scanner earlier.
            QrScanner.listCameras(true).then(cameras => cameras.forEach(camera => {
                let option = document.createElement('option')
                option.value = camera.id
                option.text = camera.label
                camList.add(option)
            }))
        })

        QrScanner.hasCamera().then(hasCamera => camHasCamera.textContent = hasCamera)

        // for debugging
        window.scanner = scanner

        document.getElementById('scan-region-highlight-style-select').addEventListener('change', (e) => {
            videoContainer.className = e.target.value
            scanner._updateOverlay() // reposition the highlight because style 2 sets position: relative
        })

        document.getElementById('inversion-mode-select').addEventListener('change', event => {
            scanner.setInversionMode(event.target.value)
        })

        camList.addEventListener('change', event => {
            scanner.setCamera(event.target.value).then(updateFlashAvailability)
        })

        flashToggle.addEventListener('click', () => {
            scanner.toggleFlash().then(() => flashState.textContent = scanner.isFlashOn() ? 'on' : 'off')
        })

        document.getElementById('start-button').addEventListener('click', () => {
            scanner.start()
        })

        document.getElementById('stop-button').addEventListener('click', () => {
            scanner.stop()
        })

        document.getElementById('destroy-button').addEventListener('click', () => {
            scanner.destroy()
            window.location.href = "{{ route('home.index') }}"
        })

        function processFill(result) {
            $.ajax({
                type: "post",
                url: "{{ route('attendance.fill') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    result: result.data,
                },
                dataType: "json",
                success: function(response) {
                    if (response.success === false) {
                        resultInfo.innerHTML = response.message
                    } else {
                        resultInfo.innerHTML = response.message
                    }
                    setTimeout(() => {
                        videoContainer.style.display = 'block'
                        resultInfo.style.display = 'none'
                        scanner.start()
                    }, 3000)
                }
            })
        }
    </script>
@endsection
