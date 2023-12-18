@forelse ($blogs as $blog)
    <div class="col">
        <div class="card">
            @forelse ($blog->media as $item)
                <img src="{{ asset('storage/banner/' . $item['filename'] . '.' . $item['extension']) }}"
                    class="card-img-top" alt="Hollywood Sign on The Hill" height="233px" />
            @empty
                <p class="fs-3 text-center"> Given Event doesn't have any image</p>
            @endforelse

            <div class="card-body">
                
                <p class="card-text">
                <div class="row" style="width: 50px">
                    {!! Illuminate\Support\Str::limit(strip_tags($blog->description), 100) !!}

                </div>
                
            </div>
        </div>
    </div>
@empty
<p class="fs-3 text-center"> {{ __('home_no_events') }} </p>
@endforelse