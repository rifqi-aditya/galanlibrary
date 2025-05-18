@extends('layouts.homeLayout')

@section('main')
    <div class="faq-accordion container py-4">
        <h2 class="text-center mb-5 fw-bold" style="color: #2c3e50;">Frequently Asked Questions</h2>

        <div class="accordion" id="faqAccordion">
            @foreach ($faqs as $category => $items)
                <div class="accordion-category mb-4">
                    <h3 class="category-title p-3 rounded" style="background-color: #F9B572; color: white;">
                        {{ $category }}
                    </h3>

                    @foreach ($items as $index => $item)
                        <div class="accordion-item border-0 mb-2 rounded overflow-hidden">
                            <h4 class="accordion-header" id="heading{{ $loop->parent->index }}{{ $loop->index }}">
                                <button class="accordion-button collapsed py-3" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{ $loop->parent->index }}{{ $loop->index }}"
                                    aria-expanded="false"
                                    aria-controls="collapse{{ $loop->parent->index }}{{ $loop->index }}"
                                    style="background-color: #f8f9fa; color: #2c3e50; font-weight: 600;">
                                    {{ $item['question'] }}
                                </button>
                            </h4>
                            <div id="collapse{{ $loop->parent->index }}{{ $loop->index }}"
                                class="accordion-collapse collapse"
                                aria-labelledby="heading{{ $loop->parent->index }}{{ $loop->index }}"
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body py-3"
                                    style="background-color: #f8f9fa; border-left: 4px solid #F9B572;">
                                    <p class="mb-0" style="color: #555;">{{ $item['answer'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <style>
        .accordion-button:not(.collapsed) {
            background-color: #e3f2fd !important;
            color: #2c3e50 !important;
            box-shadow: none;
        }

        .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        .accordion-category {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .category-title {
            font-size: 1.25rem;
            margin-bottom: 0;
        }
    </style>
@endsection
