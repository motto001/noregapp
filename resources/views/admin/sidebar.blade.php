<div class="col-md-3">

 
            <div class="panel panel-default panel-flush">
                <div class="panel-heading">
                   User Manager
                </div>

                <div class="panel-body">
                    <ul class="nav" role="tablist">
 @if (Auth::user()->hasRole('user'))                 
                            <li role="admin">
                                <a href="{{ url('/crud/workers') }}">
                                    Dolgozók
                                </a>
                            </li>
 @endif
 @if (Auth::user()->hasRole('manager'))  
                            <li role="root">
                                <a href="{{ url('/admin/users') }}">
                                    Felhasználók
                                </a>
                            </li>
 @endif
 @if (Auth::user()->hasRole('root'))                     
                            <li role="root">
                                <a href="{{ url('/admin/roles') }}">
                                    Jogok
                                </a>
                            </li>
                            <li role="root">
                                <a href="{{ url('/admin/permissions') }}">
                                    Szabályok
                                </a>
                            </li>
                            <li role="root">
                                <a href="{{ url('/admin/give-role-permissions') }}">
                                   Give role-permissions
                                </a>
                            </li>

 @endif
                         

                    </ul>
                </div>
            </div>
       @if (Auth::user()->hasRole('root'))  
            <div class="panel panel-default panel-flush">
                <div class="panel-heading">
                    Tools
                </div>

                <div class="panel-body">
                    <ul class="nav" role="tablist">
                      
                            <li role="admin">
                                <a href="{{ url('/admin/generator') }}">
                                    Generator
                                </a>
                            </li>
                        
                    </ul>
                </div>
            </div>
        @endif

</div>
