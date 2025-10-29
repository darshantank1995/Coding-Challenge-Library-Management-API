<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form action="{{ route('save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">

            @if (session('success'))
                <p>{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required value="{{ isset($student) ? $student->title : '' }}">
            </div>
            <div class="form-group">
                <label for="title">Button Title</label>
                <input type="text" class="form-control" id="btn_title" name="btn_title" required value="{{ isset($student) ? $student->btn_title : '' }}">
            </div>

            <div class="row">
                <div class="col">
                    <label for="title">Registration Start</label>
                    <input type="date" class="form-control" id="reg_date_start" name="reg_date_start" value="{{ isset($student) ? $student->reg_date_start : '' }}">
                </div>
                <div class="col">
                    <label for="title"></label>
                    <input type="time" class="form-control" id="reg_time_start" name="reg_time_start" value="{{ isset($student) ? $student->reg_time_start : '' }}">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="title">Registration end</label>
                    <input type="date" class="form-control" id="reg_date_end" name="reg_date_end" value="{{ isset($student) ? $student->reg_date_end : '' }}">
                </div>
                <div class="col">
                    <label for="title"></label>
                    <input type="time" class="form-control" id="reg_time_end" name="reg_time_end" value="{{ isset($student) ? $student->reg_time_end : '' }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Upload file</label>
                <input class="form-control" type="file" id="file" name="file">
            </div>

            <div class="form-group">
                <label for="title">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ (isset($student) && $student->status == 'active') ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ (isset($student) && $student->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <hr>
            <div style="background-color: lightgray; padding: 10px;"> Packaging </div>
            <hr>

            @php
                $array = ['LKG', 'UKG', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'];
            @endphp
            <div class="row">
                <div class="col">
                    <label for="title">Class</label>
                    <select name="pkg_class[]" id="pkg_class" class="form-control" multiple>
                        @foreach ($array as $item)
                            <option {{ (isset($student) && $student->pkg_class == $item) ? 'selected' : '' }} value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="title">Status</label>
                    <select name="pkg_status" id="pkg_status" class="form-control">
                        <option {{ (isset($student) && $student->pkg_status == 'active') ? 'selected' : '' }} value="active">Active</option>
                        <option {{ (isset($student) && $student->pkg_status == 'inactive') ? 'selected' : '' }} value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="repeater_pkg row">
                <div class="row" data-repeater-list="package_task">
                    <div class="row"  data-repeater-item>
                    <div class="col">
                        <label for="title">packege</label>
                        <input type="text" class="form-control" id="packege" name="packege" required>
                    </div>
                    <div class="col">
                        <label for="title">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="col">
                        <label for="title">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col">
                         <label for="title">&nbsp;</label>
                        <input data-repeater-delete type="button" value="Delete" class="btn btn-secondary" />
                    </div>
                    </div>
                </div>
                <br>
                <input data-repeater-create type="button" value="Add More" class="btn btn-primary" />
            </div>

             <hr>
            <div style="background-color: lightgray; padding: 10px;"> Aditional Optional </div>
            <hr>
              <div class="repeater_ad row">
                <div class="row" data-repeater-list="additional_detail">
                    <div class="row"  data-repeater-item>
                    <div class="col">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="tital" name="tital" required>
                    </div>
                    <div class="col">
                        <label for="title">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                        <div class="col">
                        <label for="title">index</label>
                        <input type="number" class="form-control" id="index" name="index" required>
                    </div>
                    <div class="col">
                        <label for="title">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col">
                         <label for="title">&nbsp;</label>
                        <input data-repeater-delete type="button" value="Delete" class="btn btn-secondary" />
                    </div>
                    </div>
                </div>
                <br>
                <input data-repeater-create type="button" value="Add More" class="btn btn-primary" />
            </div>




             <hr>
            <div style="background-color: lightgray; padding: 10px;"> Transaport Detail </div>
            <hr>
              <div class="repeater_tran row">
                <div class="row" data-repeater-list="transaport_detail">
                    <div class="row"  data-repeater-item>
                    <div class="col">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="tital" name="tital" required>
                    </div>
                    <div class="col">
                        <label for="title">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    
                    <div class="col">
                        <label for="title">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col">
                         <label for="title">&nbsp;</label>
                        <input data-repeater-delete type="button" value="Delete" class="btn btn-secondary" />
                    </div>
                    </div>
                </div>
                <br>
                <input data-repeater-create type="button" value="Add More" class="btn btn-primary" />
                <br/>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <script>
     
            $(document).ready(function() {
                $('.repeater_pkg').repeater({
                    initEmpty: true,
                    show: function() {
                        $(this).slideDown();
                    },
                    initEmpty: false,
                    // (Optional)
                    // "hide" is called when a user clicks on a data-repeater-delete
                    // element.  The item is still visible.  "hide" is passed a function
                    // as its first argument which will properly remove the item.
                    // "hide" allows for a confirmation step, to send a delete request
                    // to the server, etc.  If a hide callback is not given the item
                    // will be deleted.
                    hide: function(deleteElement) {
                        if (confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    // (Optional)
                    // You can use this if you need to manually re-index the list
                    // for example if you are using a drag and drop library to reorder
                    // list items.
                    ready: function(setIndexes) {
                       
                    },
                    // (Optional)
                    // Removes the delete button from the first list item,
                    // defaults to false.
                })

                 $('.repeater_ad').repeater({
                    initEmpty: true,
                    show: function() {
                        $(this).slideDown();
                    },
                    initEmpty: false,
                    // (Optional)
                    // "hide" is called when a user clicks on a data-repeater-delete
                    // element.  The item is still visible.  "hide" is passed a function
                    // as its first argument which will properly remove the item.
                    // "hide" allows for a confirmation step, to send a delete request
                    // to the server, etc.  If a hide callback is not given the item
                    // will be deleted.
                    hide: function(deleteElement) {
                        if (confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    // (Optional)
                    // You can use this if you need to manually re-index the list
                    // for example if you are using a drag and drop library to reorder
                    // list items.
                    ready: function(setIndexes) {
                       
                    },
                    // (Optional)
                    // Removes the delete button from the first list item,
                    // defaults to false.
                })

                  $('.repeater_tran').repeater({
                    initEmpty: true,
                    show: function() {
                        $(this).slideDown();
                    },
                    initEmpty: false,
                    // (Optional)
                    // "hide" is called when a user clicks on a data-repeater-delete
                    // element.  The item is still visible.  "hide" is passed a function
                    // as its first argument which will properly remove the item.
                    // "hide" allows for a confirmation step, to send a delete request
                    // to the server, etc.  If a hide callback is not given the item
                    // will be deleted.
                    hide: function(deleteElement) {
                        if (confirm('Are you sure you want to delete this element?')) {
                            $(this).slideUp(deleteElement);
                        }
                    },
                    // (Optional)
                    // You can use this if you need to manually re-index the list
                    // for example if you are using a drag and drop library to reorder
                    // list items.
                    ready: function(setIndexes) {
                       
                    },
                    // (Optional)
                    // Removes the delete button from the first list item,
                    // defaults to false.
                })
            });
        </script>
    </body>

        </html>
