<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('admin/assets/img/icon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('admin/assets/css/fonts.min.css') }}']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/atlantis.css') }}">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}">
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">

                <a href="index.html" class="logo">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                    {{-- <img style="width: 110px;" src="{{ asset('assets/img/logo1.png') }}" alt="navbar brand"
                        class="navbar-brand"> --}}
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            @include('admin.layout.navbar')
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('admin.layout.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="container">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold">@yield('title')</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="copyright ml-auto">
                        {{ date('d-m-Y H:m') }}
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('admin/assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('admin/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Moment JS -->
    <script src="{{ asset('admin/assets/js/plugin/moment/moment.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('admin/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('admin/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- Bootstrap Toggle -->
    <script src="{{ asset('admin/assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('admin/assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Google Maps Plugin -->
    <script src="{{ asset('admin/assets/js/plugin/gmaps/gmaps.js') }}"></script>

    <!-- Dropzone -->
    <script src="{{ asset('admin/assets/js/plugin/dropzone/dropzone.min.js') }}"></script>

    <!-- Fullcalendar -->
    <script src="{{ asset('admin/assets/js/plugin/fullcalendar/fullcalendar.min.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('admin/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js') }}"></script>

    <!-- Bootstrap Tagsinput -->
    <script src="{{ asset('admin/assets/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>

    <!-- Bootstrap Wizard -->
    <script src="{{ asset('admin/assets/js/plugin/bootstrap-wizard/bootstrapwizard.js') }}"></script>

    <!-- jQuery Validation -->
    <script src="{{ asset('admin/assets/js/plugin/jquery.validate/jquery.validate.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('admin/assets/js/plugin/summernote/summernote-bs4.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('admin/assets/js/plugin/select2/select2.full.min.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('admin/assets/js/plugin/owl-carousel/owl.carousel.min.js') }}"></script>

    <!-- Magnific Popup -->
    <script src="{{ asset('admin/assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('admin/assets/js/atlantis.min.js') }}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            if (!ace.vars['touch']) {
                // chosen select
                $('.chosen-select').chosen({
                    allow_single_deselect: true
                });
                //resize the chosen on window resize

                $(window)
                    .off('resize.chosen')
                    .on('resize.chosen', function() {
                        $('.chosen-select').each(function() {
                            var $this = $(this);
                            $this.next().css({
                                'width': $this.parent().width()
                            });
                        })
                    }).trigger('resize.chosen');
                //resize chosen on sidebar collapse/expand
                $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                    if (event_name != 'sidebar_collapsed') return;
                    $('.chosen-select').each(function() {
                        var $this = $(this);
                        $this.next().css({
                            'width': $this.parent().width()
                        });
                    })
                });


                $('#chosen-multiple-style .btn').on('click', function(e) {
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    if (which == 2) $('#form-field-select-4').addClass('tag-input-style');
                    else $('#form-field-select-4').removeClass('tag-input-style');
                });
            }

            // tooltip
            $('[data-rel=tooltip]').tooltip();

            // input mask
            $('.input-mask-pukul').mask('99:99');

            // datepicker plugin
            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true
            })

            // initiate dataTables plugin
            var oTable1 =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aaSorting": [
                        [0, "asc"]
                    ],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });

            $('#data-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .dataTable({
                    bAutoWidth: false,
                    "aaSorting": [
                        [0, "asc"]
                    ],

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    "sScrollX": "100%",
                    "sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50
                });
            //oTable1.fnAdjustColumnSizing();

            $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                no_file: 'Tidak ada file ...',
                btn_choose: 'Browse',
                btn_change: 'Change',
                droppable: false,
                onchange: null,
                thumbnail: false, //| true | large
                whitelist: 'gif|png|jpg|jpeg'
                //blacklist:'exe|php'
                //onchange:''
                //
            });
            //pre-show a file name, for example a previously selected file
            //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])

            $('#myTab a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                //if($(e.target).attr('href') == "#home") doSomethingNow();
            })

            var $sidebar = $('.sidebar').eq(0);
            if (!$sidebar.hasClass('h-sidebar')) return;

            $(document).on('settings.ace.top_menu', function(ev, event_name, fixed) {
                if (event_name !== 'sidebar_fixed') return;

                var sidebar = $sidebar.get(0);
                var $window = $(window);

                //return if sidebar is not fixed or in mobile view mode
                var sidebar_vars = $sidebar.ace_sidebar('vars');
                if (!fixed || (sidebar_vars['mobile_view'] || sidebar_vars['collapsible'])) {
                    $sidebar.removeClass('lower-highlight');
                    //restore original, default marginTop
                    sidebar.style.marginTop = '';

                    $window.off('scroll.ace.top_menu')
                    return;
                }


                var done = false;
                $window.on('scroll.ace.top_menu', function(e) {

                    var scroll = $window.scrollTop();
                    scroll = parseInt(scroll /
                        4); //move the menu up 1px for every 4px of document scrolling
                    if (scroll > 2) scroll = 2;


                    if (scroll > 1) {
                        if (!done) {
                            $sidebar.addClass('lower-highlight');
                            done = true;
                        }
                    } else {
                        if (done) {
                            $sidebar.removeClass('lower-highlight');
                            done = false;
                        }
                    }

                    sidebar.style['marginTop'] = (2 - scroll) + 'px';
                }).triggerHandler('scroll.ace.top_menu');

            }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass('sidebar-fixed')]);

            $(window).on('resize.ace.top_menu', function() {
                $(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed', $sidebar.hasClass(
                    'sidebar-fixed')]);
            });
        });
    </script>

    <script src="{{ asset('admin/assets/plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        var roxyFileman = '{{ asset(`admin/assets/plugins/ckeditor/plugins/fileman/index.html`) }}';
        $(function() {
            CKEDITOR.replace('ckeditor', {
                filebrowserBrowseUrl: roxyFileman,
                filebrowserImageBrowseUrl: roxyFileman + '?type=image',
                removeDialogTabs: 'link:upload;image:upload'
            });
        });
    </script>

    @yield('script')
</body>

</html>
