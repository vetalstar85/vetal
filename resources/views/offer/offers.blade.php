@extends('layouts.main')
@section('content')






    <div class="album py-5 bg-light mt-5">
        <div class="container">
            @if(Auth::user())
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <a href="{{route('offers-add')}}" type="button" class="btn btn-info text-white">add new offer</a>

                </div>

            </div>
            @endif

            <div class="row">
                @foreach($offers as $offer)

                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{$offer->getPreview()}}" height="200">
                        <div class="card-body">
                            <p class="card-text">{{$offer['id']}}{{$offer['title']}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('offers-view',$offer['id'])}}" type="button" class="btn btn-sm btn-outline-secondary">View</a>
                                    @if(Auth::user()&& Auth::user()->id == $offer['user_id'])
                                    <a href="{{route('offers-edit',$offer['id'])}}" type="button" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <a href="{{route('offers-remove',$offer['id'])}}" type="button" class="btn btn-sm btn-outline-danger">Remove</a>
                                @endif
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                    @endforeach
            </div>
            <div>
                @if(!isset($search))
                    <div>
                        {!! $offers->links() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

</main>

@endsection
