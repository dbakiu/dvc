
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home.index') }}">Home</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Invoices<span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('invoice.index') }}">Invoices list</a></li>
                       <li><a href="{{ route('invoice.create') }}">New invoice</a></li>
                     </ul>
                </li>

                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vehicles<span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('vehicle.index') }}">Vehicles list</a></li>
                       <li><a href="{{ route('vehicle.create') }}">Add vehicle type</a></li>
                     </ul>
                </li>
                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Employees<span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('employee.index') }}">Employees list</a></li>
                       <li><a href="{{ route('employee.create') }}">Add employee</a></li>
                     </ul>
                </li>
                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Expenses<span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('expense.index') }}">Expenses list</a></li>
                       <li><a href="{{ route('expense.create') }}">Add expense</a></li>
                     </ul>
                </li>
                <li>
                    <a href="{{ route('balance.index'); }}">Balance</a>
                </li>
                <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Backup<span class="caret"></span></a>
                     <ul class="dropdown-menu" role="menu">
                       <li><a href="{{ route('database.backup') }}">Backup database</a></li>
                       <li><a href="{{ route('database.restore') }}">Restore database</a></li>
                     </ul>
                </li>
            </ul>

            <div class="logout_button">
                @include('layout.logout')
            </div>
        </div>

        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
