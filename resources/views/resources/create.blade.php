@extends('layouts.app_no_chat')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>Add new resource</h3>
                </div>
            </div>
            <div id="edit-profile" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        @if (session()->has('errors'))
                            @foreach ($errors as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        @if (\Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ Session::get('message') }}
                            </p>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('resources.store') }}"
                            enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                                <label class="col-lg-2 control-label">Resource Title</label>
                                <div class="col-lg-10">
                                    <input name="title" type="text" class="form-control" value="" />
                                </div>
                            </div>
                            @error('title')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Category</label>
                                <div class="col-lg-10">
                                    <select name="category" class="form-control">
                                        <option value="default"></option>
                                        <option value="software">Software</option>
                                        <option value="art_images">Art & Images</option>
                                        <!-- Add more category options as needed -->
                                    </select>
                                </div>
                            </div>
                            @error('category')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Version</label>
                                <div class="col-lg-10">
                                    <input name="version" type="text" class="form-control" value="" />
                                    <span>the version number of your upload, (1.0) for example</span>
                                </div>
                            </div>
                            @error('version')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Resource Image</label>
                                <div class="col-lg-10">
                                    <input type="file" name="image" class="form-control" />
                                </div>
                            </div>
                            @error('image')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Resource Description</label>
                                <div class="col-lg-10">
                                    <textarea name="description" id="editor1" class="form-control" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            @error('description')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Choose resource</label>
                                <div class="col-lg-10">
                                    <input type="file" name="format" class="form-control" />
                                    <label for="">Accepted upload extensions:
                                        zip, rar, 7z, tar, txt, mp3, wav, ogg, avi, mpg, mpeg, mkv, iso,
                                        pdf, png, jpg, jpeg, jpe, gif, psd, tif, bsp, dem, vtf, vmt, cfg, ini, sp,
                                        py</label>
                                </div>
                            </div>
                            @error('format')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Tag Line</label>
                                <div class="col-lg-10">
                                    <input name="tag_line" type="text" class="form-control" value="" />
                                    <span>Provide a very brief, one-line description of your resource.</span>
                                </div>
                            </div>
                            @error('tag_line')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Additional information URL</label>
                                <div class="col-lg-10">
                                    <input name="url" type="url" class="form-control" value="" />
                                    <span>
                                        If you have your own web page containing a demo, extended description or support
                                        services etc. for this resource, enter its URL here.
                                    </span>
                                </div>
                            </div>
                            @error('url')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </section>
    </section>
@endsection
