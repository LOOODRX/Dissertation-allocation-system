<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Topic<span>Management</span>
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          <li class="nav-item nav-category">Main</li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Dissertation topic </li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.upload') }}" class="nav-link">
              <i class="link-icon" data-feather="upload"></i>
              <span class="link-title">Upload Topic</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.preview') }}" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">View Topic List</span>
            </a>
          </li>
          <li class="nav-item nav-category">Allocation of dissertations</li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.allocationList') }}" class="nav-link">
              <i class="link-icon" data-feather="user-check"></i>
              <span class="link-title">Student choice list</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.viewAllocationResult') }}" class="nav-link">
              <i class="link-icon" data-feather="file-text"></i>
              <span class="link-title">Allocation list</span>
            </a>
          </li>
          <li class="nav-item nav-category">User managment</li>
          <li class="nav-item">
            <a href="{{ route('modul_owner.uploadUserTable') }}" class="nav-link">
              <i class="link-icon" data-feather="user-plus"></i>
              <span class="link-title">Upload new user</span>
            </a>
            <li class="nav-item">
              <a href="{{ route('modul_owner.showUserList') }}" class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">View user list</span>
              </a>
          </li>
         
          <li class="nav-item nav-category">Docs</li>
          <li class="nav-item">
            <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
              <i class="link-icon" data-feather="hash"></i>
              <span class="link-title">Documentation</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>