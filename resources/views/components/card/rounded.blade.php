<div class="card shadow border-0">
    {{-- <img src="{{$img}}" class="card-img-top img-fluid" alt="story-image"> --}}
    <div class="img_pad" style="background-image: url({{$img}})"></div>
    <div class="card-body">
        <h5 class="card-title font-fredoka text-truncate">{{$title}}</h5>
        <div class="d-flex justify-content-start gap-3">
            <div>
                <i class="fa-solid fa-eye"></i>
                <span class="font-size-12">{{$see}}</span>
            </div>
            <div>
                <i class="fa-solid fa-heart" style="color: #e64c4c;"></i>
                <span class="font-size-12">{{$like}}</span>
            </div>
        </div>

        <p class="card-text mt-3">
           
        </p>
        <x-button.primary-green class="w-100">
            {{$btn}}
        </x-button.primary-green>
        {{$slot}}
    </div>
</div>