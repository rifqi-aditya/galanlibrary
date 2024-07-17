document.addEventListener('DOMContentLoaded', () => {
    $('.select2').select2({
        width: '100%'
    })
    new DataTable('#user-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [1, 6]
            },
        ]
    })
    new DataTable('#category-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [3]
            },
        ]
    })
    new DataTable('#bookshelf-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [3]
            },
        ]
    })
    new DataTable('#publisher-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [4]
            },
        ]
    })
    new DataTable('#role-table')
    new DataTable('#book-table', {
        columnDefs: [
            {
                orderable: false,
                targets: []
            },
        ]
    })
    new DataTable('#active-borrowing-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [6]
            },
        ]
    })
    new DataTable('#returned-borrowing-table', {
        columnDefs: [
            {
                orderable: false,
                targets: [8]
            },
        ]
    })
})

function createProgressbar(id, duration, callback) {
    let progressbar = document.getElementById(id)
    progressbar.className = 'progressbar'
    let progressbarinner = document.createElement('div')
    progressbarinner.className = 'inner'
    progressbarinner.style.animationDuration = duration
    if (typeof (callback) === 'function') {
        progressbarinner.addEventListener('animationend', callback)
    }
    progressbar.innerHTML = ''
    progressbar.appendChild(progressbarinner)
    progressbarinner.style.animationPlayState = 'running'
}

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})