@extends('layouts.layout_admins.main')
@section('title', 'category-product')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length" id="example1_length">
                                    <label>Show
                                        <select name="example1_length" class="form-control-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select> entries</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <form method="get">
                                    <div id="dataTables_length" class="dataTables_filter">
                                        <label class="form-control-sm">Search:
                                            <input type="search" id="searh_product" class="form-control-sm" name="search"
                                                placeholder="">
                                        </label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="tableCategoryProduct" class="table table-bordered table-striped">

                            {{-- <div id="example1"><label>Search:<input type="search"
                                        id="searh_product" class="form-control form-control-sm" placeholder=""
                                        aria-controls="example1"></label></div> --}}
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>category parent</th>
                                    <th>
                                        <a data-toggle="modal" data-target="#modalcategory" onclick="newform()"><i
                                                class="fa fa-plus-square text-primary"></i> New Category
                                        </a>
                                    </th>

                                </tr>
                            </thead>
                            <tbody id="search_Show">
                                {{-- @foreach ($cates as $cate)
                                    <tr>
                                        <th>{{ $cate->id }}</th>
                                        <th>{{ $cate->name }}</th>
                                        <th>{{ isset($cate->cate) ? $cate->cate->name : '' }}</th>
                                        <th>
                                            <a class="btn btn-primary" onclick="update(this,{{ $cate->id }})"
                                                data-toggle="modal" data-target="#modalcategory">
                                                update</a>
                                            <a class="btn btn-danger"
                                                onclick="DeleteCategory(this,{{ $cate->id }})">delete</a>
                                        </th>
                                    </tr>
                                @endforeach --}}

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-2 " id="paga-link">
                            {{-- <nav>
                                <ul class="pagination" id="parent_page">
                                    <li class="page-item disabled pre" aria-disabled="true" aria-label="« Previous">
                                        <span class="page-link" aria-hidden="true">‹</span>
                                    </li>
                                    <li class="page-item page active" value="1" aria-current="page"><span
                                            class="page-link">1</span></li>
                                    <li class="page-item page" value="2" aria-current="page"><span
                                            class="page-link">2</span></li>
                                    <li class="page-item page" value="3" aria-current="page"><span
                                            class="page-link">3</span></li>
                                    <li class="page-item next">
                                        <a class="page-link" rel="next" aria-label="Next »">›</a>
                                    </li>
                                </ul>
                            </nav> --}}
                        </div>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div>
    </div>
    {{-- modal category product --}}
    @include('admin.category_product.form')
@endsection
@section('js')
    <script src="{{ asset('admin/js/admin/cateProduct.js') }}"></script>
    <script type="text/javascript">
        window.addEventListener('load', function(e) {
            let tableCategoryProduct = document.getElementById('tableCategoryProduct');
            $.ajax({
                url: '../../api/category-product/list',
                type: 'get',
                success: function(data) {
                    console.log(data)
                    let countCate = data.totalCate;
                    let TotlaPage = Math.ceil(countCate / 2);
                    let showPagaLink =
                        `<nav >
                                <ul class="pagination" id="parent_page">
                                <li class="page-item disabled pre" aria-disabled="true" aria-label="« Previous">
                                <span class="page-link" aria-hidden="true">‹</span>
                                </li>
                                <li class="page-item page active" value="1"  aria-current="page"><span class="page-link">1</span></li> `;
                    for (var i = 2; i <= TotlaPage; i++) {
                        showPagaLink += `<li class="page-item page" value="` + i +
                            `"  aria-current="page"><span class="page-link">` + i + `</span></li> `;
                    }
                    showPagaLink += ` <li class="page-item next">
                                <a class="page-link" rel="next" aria-label="Next »">›</a>
                                </li>
                                </ul>
                                </nav>`;
                    let show = '';
                    for (var i = data.cates.length - 1; i >= 0; i--) {

                        let parent_name = data.cates[i].parent == null ? 'null' : data.cates[i].parent
                            .name;
                        show += `<tr>
                                          <th>` + data.cates[i].id + `</th>
                                          <th>` + data.cates[i].name + `</th>
                                          <th>` + parent_name + `</th>
                                          <th>
                                            <a class="btn btn-primary" onclick="update(this,` + data.cates[i].id + `)" data-toggle="modal" data-target="#modalcategory">
                                            update</a>
                                            <a class="btn btn-danger" onclick="DeleteCategory(this,` + data.cates[i].id + `)">delete</a>
                                          </th>
                                        </tr>`;
                    }
                    // console.log(show)
                    $('#search_Show').html(show);
                    document.getElementById('paga-link').innerHTML = showPagaLink;
                    // console.log(showPagaLink)
                    let parent_page = document.getElementById("parent_page");
                    let pages = parent_page.getElementsByClassName("page");
                    for (let i = 0; i < pages.length; i++) {
                        pages[i].addEventListener("click", function() {

                            $('li').removeClass("active");
                            this.className += " active";
                            const id = $(this).val();
                            console.log(id)
                            $.ajax({
                                url: '../../api/category-product/list',
                                type: 'GET',
                                data: {
                                    page: id
                                },
                                success: function(data) {
                                    console.log(data.id)
                                    console.log(data.cates)
                                    for (var i = data.cates.length - 1; i >=
                                        0; i--) {

                                        let parent_name = data.cates[i].parent ==
                                            null ? 'null' : data.cates[i].parent
                                            .name;
                                        show += `<tr>
                                         <th>` + data.cates[i].id + `</th>
                                         <th>` + data.cates[i].name + `</th>
                                         <th>` + parent_name + `</th>
                                         <th>
                                           <a class="btn btn-primary" onclick="update(this,` + data.cates[i].id + `)" data-toggle="modal" data-target="#modalcategory">
                                           update</a>
                                           <a class="btn btn-danger" onclick="DeleteCategory(this,` + data.cates[i].id + `)">delete</a>
                                         </th>
                                       </tr>`;
                                    }
                                    console.log(show)
                                    $('#search_Show').html(show);

                                }

                            })


                            console.log(id);

                        });
                    }

                    $('.pre').click(function() {
                        let parent_page = document.getElementById("parent_page");
                        let pages = parent_page.getElementsByClassName("page");
                        const id = $('.active').val();
                        const i = id - 2 < 0 ? 0 : id - 2;
                        $('li').removeClass("active");

                        pages[i].className += " active";

                        console.log(id)
                        $.ajax({
                            url: '../../api/category-product/list',
                            type: 'GET',
                            data: {
                                page: id - 1
                            },
                            success: function(data) {
                                console.log(data.id)
                                console.log(data.cates)
                                for (var i = data.cates.length - 1; i >=
                                    0; i--) {

                                    let parent_name = data.cates[i].parent ==
                                        null ? 'null' : data.cates[i].parent
                                        .name;
                                    show += `<tr>
                                         <th>` + data.cates[i].id + `</th>
                                         <th>` + data.cates[i].name + `</th>
                                         <th>` + parent_name + `</th>
                                         <th>
                                           <a class="btn btn-primary" onclick="update(this,` + data.cates[i].id + `)" data-toggle="modal" data-target="#modalcategory">
                                           update</a>
                                           <a class="btn btn-danger" onclick="DeleteCategory(this,` + data.cates[i].id + `)">delete</a>
                                         </th>
                                       </tr>`;
                                }
                                // console.log(show)
                                $('#search_Show').html(show);

                            }

                        })
                    });


                    $('.next').click(function() {
                        let parent_page = document.getElementById("parent_page");
                        let pages = parent_page.getElementsByClassName("page");
                        const id = $('.active').val();
                        const i = id;
                        if (i < pages.length - 1) {
                            $('li').removeClass("active");

                            pages[i].className += " active";

                            console.log(id, i)
                            $.ajax({
                                url: '../../api/category-product/list',
                                type: 'GET',
                                data: {
                                    page: id + 1
                                },
                                success: function(data) {
                                    console.log(data.id)
                                    console.log(data.cates)
                                    for (var i = data.cates.length - 1; i >=
                                        0; i--) {

                                        let parent_name = data.cates[i].parent ==
                                            null ? 'null' : data.cates[i].parent
                                            .name;
                                        show += `<tr>
                                     <th>` + data.cates[i].id + `</th>
                                     <th>` + data.cates[i].name + `</th>
                                     <th>` + parent_name + `</th>
                                     <th>
                                       <a class="btn btn-primary" onclick="update(this,` + data.cates[i].id + `)" data-toggle="modal" data-target="#modalcategory">
                                       update</a>
                                       <a class="btn btn-danger" onclick="DeleteCategory(this,` + data.cates[i].id + `)">delete</a>
                                     </th>
                                   </tr>`;
                                    }
                                    // console.log(show)
                                    $('#search_Show').html(show);

                                }

                            })
                        }
                    });
                }
            })
        });
        $(document).ready(function() {

        });

    </script>
@endsection
