<style>
    .image img {
        height: 2.1rem;
    }
</style>
@if (auth()->user()->profile_image)
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/') . ('images/' . auth()->user()->profile_image) }}"
                onerror="this.onerror=null;this.src='{{ asset('/') }}images/avtar.jpeg';" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>
@else
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/') }}images/avtar.jpeg"
                onerror="this.onerror=null;this.src='{{ asset('/') }}images/avtar.jpeg';" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
    </div>
@endif
