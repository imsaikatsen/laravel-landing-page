<x-app-layout>
    <style>
        /* Modern Dashboard Theme */
        :root {
            --sidebar-blue: #1a2d4c;
            --bg-light: #f4f7f9;
            --text-muted: #8e99a7;
            --accent-orange: #ff9f43;
        }

        body {
            background-color: var(--bg-light) !important;
        }

        /* Sidebar Styling */
        .sidebar-wrapper {
            background-color: var(--sidebar-blue);
            min-height: 100vh;
            color: white;
            padding-top: 40px;
            position: fixed;
            width: 240px;
            z-index: 100;
        }

        .profile-box {
            text-align: center;
            padding: 0 20px 40px;
        }

        .avatar-circle {
            width: 85px;
            height: 85px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .user-name {
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        .user-email {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-menu li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            padding: 12px 30px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        .nav-menu li a:hover {
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
        }

        .nav-menu li a i {
            margin-right: 15px;
            width: 20px;
            text-align: center;
            opacity: 0.8;
        }

        /* Main Content Layout */
        .main-container {
            margin-left: 240px;
            /* Width of sidebar */
            padding: 20px 40px;
        }

        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 10px 0;
        }

        .page-title {
            font-size: 1.6rem;
            color: #444;
            font-weight: 500;
        }

        .hamburger-menu {
            color: #666;
            cursor: pointer;
        }

        /* Stats Card Logic (Optional Preview) */
        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            border: none;
            height: 100%;
        }

        /* Responsive Fix */
        @media (max-width: 768px) {
            .sidebar-wrapper {
                width: 70px;
            }

            .main-container {
                margin-left: 70px;
            }

            .user-name,
            .user-email,
            .nav-text {
                display: none;
            }

            .nav-menu li a {
                justify-content: center;
                padding: 15px 0;
            }

            .nav-menu li a i {
                margin-right: 0;
            }
        }

        .note-editor.note-frame {
            border: 1px solid #ced4da;
        }

        .note-editable {
            min-height: 220px;
        }
    </style>
    <link href="{{ asset('css/summernote-bs5.min.css') }}" rel="stylesheet">
    @stack('styles')

    <div class="container-fluid p-0">
        <div class="d-flex">
            <div class="sidebar-wrapper shadow">
                <div class="profile-box">
                    <div class="avatar-circle">
                        <i class="fa fa-user"></i>
                    </div>
                    <div class="user-name">{{ Auth::user()->name }}</div>
                    <div class="user-email">{{ Auth::user()->email }}</div>
                </div>

                <ul class="nav-menu">
                    <li><a href="{{ route('slider.index') }}"><i class="fa-solid fa-sliders"></i> <span
                                class="nav-text">Slider</span></a></li>
                    <li><a href="{{ route('miniapp.index') }}"><i class="fa-brands fa-app-store"></i><span class="nav-text">APP</span></a></li>
                    <li><a href="{{ route('datingzone.index') }}"><i class="fa-regular fa-face-laugh"></i> <span class="nav-text">Dating Zone</span></a></li>
                    <li><a href="{{ route('livezone.index') }}"><i class="fa-solid fa-bolt"></i> <span class="nav-text">Live Zone</span></a></li>
                    <li><a href="{{ route('mallproducts.index') }}"><i class="fa-brands fa-airbnb"></i> <span class="nav-text">Sex Mall</span></a></li>
                    <li><a href="{{ route('pageseo.index') }}"><i class="fa-brands fa-sistrix"></i> <span class="nav-text">Meta Tags</span></a></li>
                </ul>
            </div>

            <div class="main-container w-100">

                <header class="top-header">
                    <h1 class="page-title">Admin Area</h1>
                    <div class="hamburger-menu">
                        <i class="fa fa-bars fa-lg"></i>
                    </div>
                </header>

                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/summernote-bs5.min.js') }}"></script>
        <script>
            $(function () {
                $('.summernote-editor').summernote({
                    height: 260,
                    placeholder: 'Write content here...',
                    icons: {
                        align: '<i class="fa-solid fa-align-left"></i>',
                        alignCenter: '<i class="fa-solid fa-align-center"></i>',
                        alignJustify: '<i class="fa-solid fa-align-justify"></i>',
                        alignLeft: '<i class="fa-solid fa-align-left"></i>',
                        alignRight: '<i class="fa-solid fa-align-right"></i>',
                        rowBelow: '<i class="fa-solid fa-row"></i>',
                        colBefore: '<i class="fa-solid fa-table-columns"></i>',
                        colAfter: '<i class="fa-solid fa-table-columns"></i>',
                        colRemove: '<i class="fa-solid fa-trash"></i>',
                        rowAbove: '<i class="fa-solid fa-row"></i>',
                        rowRemove: '<i class="fa-solid fa-trash"></i>',
                        indent: '<i class="fa-solid fa-indent"></i>',
                        outdent: '<i class="fa-solid fa-outdent"></i>',
                        arrowsAlt: '<i class="fa-solid fa-expand"></i>',
                        bold: '<i class="fa-solid fa-bold"></i>',
                        caret: '<i class="fa-solid fa-caret-down"></i>',
                        circle: '<i class="fa-regular fa-circle"></i>',
                        close: '<i class="fa-solid fa-xmark"></i>',
                        code: '<i class="fa-solid fa-code"></i>',
                        eraser: '<i class="fa-solid fa-eraser"></i>',
                        font: '<i class="fa-solid fa-font"></i>',
                        frame: '<i class="fa-regular fa-square"></i>',
                        italic: '<i class="fa-solid fa-italic"></i>',
                        link: '<i class="fa-solid fa-link"></i>',
                        unlink: '<i class="fa-solid fa-link-slash"></i>',
                        magic: '<i class="fa-solid fa-wand-magic-sparkles"></i>',
                        menuCheck: '<i class="fa-solid fa-check"></i>',
                        minus: '<i class="fa-solid fa-minus"></i>',
                        orderedlist: '<i class="fa-solid fa-list-ol"></i>',
                        pencil: '<i class="fa-solid fa-pen"></i>',
                        picture: '<i class="fa-regular fa-image"></i>',
                        question: '<i class="fa-regular fa-circle-question"></i>',
                        redo: '<i class="fa-solid fa-rotate-right"></i>',
                        rollback: '<i class="fa-solid fa-rotate-left"></i>',
                        square: '<i class="fa-regular fa-square"></i>',
                        strikethrough: '<i class="fa-solid fa-strikethrough"></i>',
                        subscript: '<i class="fa-solid fa-subscript"></i>',
                        superscript: '<i class="fa-solid fa-superscript"></i>',
                        table: '<i class="fa-solid fa-table"></i>',
                        textHeight: '<i class="fa-solid fa-text-height"></i>',
                        trash: '<i class="fa-solid fa-trash"></i>',
                        underline: '<i class="fa-solid fa-underline"></i>',
                        undo: '<i class="fa-solid fa-rotate-left"></i>',
                        unorderedlist: '<i class="fa-solid fa-list-ul"></i>',
                        video: '<i class="fa-solid fa-video"></i>'
                    },
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview']]
                    ]
                });
            });
        </script>
        @stack('scripts')
    </div>
</x-app-layout>
