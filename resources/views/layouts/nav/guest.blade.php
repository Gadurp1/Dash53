<nav class="navbar navbar-default navbar-fixed-top" style="background:#fff;padding-bottom:1em;padding-top:1em">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <div class="hamburger">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <!-- Branding Image -->
            @include('layouts.nav.brand')
        </div>

        <div class="collapse navbar-collapse" id="spark-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
              @include('layouts.nav.user-right')
              <div class="hidden">

                                <li><a href="/login" class="navbar-link"><strong>Login</strong></a></li>
                                <li><a href="/register" class="navbar-link"><strong>Register</strong></a></li>
              </div>
            </ul>
        </div>
    </div>
</nav>
<br><br>
