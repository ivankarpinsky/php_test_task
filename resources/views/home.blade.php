@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @isset ($currentDirectory)
                            {{$currentDirectory->getAttribute('name')}}
                        @else
                            Home directory:
                        @endisset
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="/home">Home</a>
                        @isset($breadCrumbs)
                            @for($i=count($breadCrumbs);$i--;$i>=0)
                                / <a href="/directory/{{$breadCrumbs[$i]['id']}}">{{$breadCrumbs[$i]['name']}}</a>
                            @endfor
                        @endisset
                        <br><br>
                        @foreach($directories as $directory)
                            <div class="file-card">
                                <div>
                                    <img class="icon" src="../icons/folder.ico">
                                    <form class="hidden" method="post" action="{{route('directory.rename')}}">{{csrf_field()}}<input type="hidden" name="id" value="{{$directory->getAttribute('id')}}"><input name="name" placeholder="Enter new name"><button type="submit">Rename</button></form><a class="file-name" href="{{'/directory/'.$directory->getAttribute('id')}}">{{$directory->getAttribute('name')}}</a><a href="/directory/delete/{{$directory->getAttribute('id')}}">Delete</a><a href="" class="rename">Rename</a>
                                </div>
                            </div>
                        @endforeach
                        @foreach($files as $file)
                            <div class="file-card">
                                <img class="icon" src="../icons/file.ico">
                                <form class="hidden" method="post" action="{{route('file.rename')}}">{{csrf_field()}}<input type="hidden" name="id" value="{{$file->getAttribute('id')}}"><input name="name" placeholder="Enter new name"><button type="submit">Rename</button></form><a class="file-name"
                                    href="{{'/storage/'.$file->getAttribute('path')}}">{{$file->getAttribute('usersName')." (".$file->getAttribute('size')." Bytes)"}}</a><a href="/file/delete/{{$file->getAttribute('id')}}">Delete</a><a href="" class="rename">Rename</a>
                            </div>
                        @endforeach
                        <br>
                        <div id="create-folder">Create folder:</div>
                        <form id="folder-form" class="hidden" action="{{route('directory.create')}}"
                              method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="text" name="name">
                            <input type="hidden" name="directory_id" value="{{$directory_id??0}}">
                            <button class="btn btn-default" type="submit">Create</button>
                        </form>
                        <br>
                        <div id="upload-file">Upload file:</div>
                        <form id="file-form" class="hidden" action="{{route('file.upload')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="directory_id" value="{{$directory_id??0}}">
                            <input type="file" name="file">
                            <button class="btn btn-default" type="submit">Upload</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
