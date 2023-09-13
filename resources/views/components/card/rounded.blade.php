<div class="card">
    <img src="{{$img}}" class="card-img-top" alt="story-image">
    <div class="card-body">
        <h5 class="card-title font-fredoka">{{$title}}</h5>
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
           {{$slot}}
        </p>
        <x-button.primary-green class="w-100">
            {{$btn}}
        </x-button.primary-green>
    </div>
</div>