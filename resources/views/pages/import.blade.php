@extends('layouts.app')

@section('content')

<section class="bg-light py-5">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xxl-8">
               <form method="POST" action="{{ route('page.import.process') }}" enctype="multipart/form-data">
                   @csrf
                   <input type="file" name="words_doc" class="form-control">
                   <input type="submit" name="" value="Importuj do bazy"  class="btn btn-primary mt-3">
               </form>
            </div>
        </div>
    </div>
</section>
@endsection

