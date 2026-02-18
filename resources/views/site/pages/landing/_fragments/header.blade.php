<style>
    /* Sticky Header - stays at the top of the mobile-wrapper */
    .mobile-header {
        position: sticky;
        top: 0;
        z-index: 1060;
        background-color: #000000;
        border-bottom: 1px solid #2d2d2d;
        width: 100%;
    }

    /* Semantic List Reset */
    .nav-menu {
        list-style: none;
        margin: 0;
        padding: 5px 0;
        display: flex;
        justify-content: space-around;
        align-items: center;
    }

    .nav-item {
        flex: 1;
    }

    .nav-link {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: #777; /* Inactive text color */
        padding: 5px 0;
        transition: 0.2s ease-in-out;
    }

    /* Icons and Text sizing */
    .nav-link i {
        font-size: 1.25rem;
        margin-bottom: 2px;
    }

    .nav-link span {
        font-size: 0.65rem;
        font-weight: 500;
    }

    /* Green Active State (Matching your original screenshot) */
    .nav-link.active {
        color: #198754; /* Bootstrap success green */
    }

    /* Visual feedback on click/touch */
    .nav-link:active {
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
    }
</style>

<header class="mobile-header">
    <nav>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link active">
                    <span>首页</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span>交友</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <span>直播</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                   <span>商城</span>
                </a>
            </li>
        </ul>
    </nav>
</header>