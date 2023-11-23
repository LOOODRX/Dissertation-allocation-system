<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
          Topic<span>Selection</span>
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
            <a href="{{ route('student.dashboard') }}" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item nav-category">Dissertation topic </li>
          <li class="nav-item">
            <a href="{{ route('student.topicList') }}" class="nav-link">
              <i class="link-icon" data-feather="calendar"></i>
              <span class="link-title">Topic list</span>
          </a>          
          </li>
          <li class="nav-item nav-category">select topic</li>
          <li class="nav-item">
            <a href="{{ route('student.uploadTopic') }}" class="nav-link">
              <i class="link-icon" data-feather="feather"></i>
              <span class="link-title">Select</span>
            </a>
            
          </li>
          <li class="nav-item">
          <a href="{{ route('student.reviewSelectList') }}" class="nav-link">
            <i class="link-icon" data-feather="file-text"></i>
            <span class="link-title">Selected Topic</span>
          </a>
        </li>

        <li class="nav-item nav-category">Allocation Result</li>
          <li class="nav-item">
            <a href="{{ route('student.viewAllocationResult') }}" class="nav-link">
              <i class="link-icon" data-feather="lock"></i>
              <span class="link-title">Allocation Result</span>
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
    <nav class="settings-sidebar">
      <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
          <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
          <h6 class="text-muted mb-2">Light Theme:</h6>
          <a class="theme-item" href="../demo1/dashboard.html">
            <img src="../assets/images/screenshots/light.jpg" alt="light theme">
          </a>
          <h6 class="text-muted mb-2">Dark Theme:</h6>
          <a class="theme-item active" href="../demo2/dashboard.html">
            <img src="../assets/images/screenshots/dark.jpg" alt="light theme">
          </a>
        </div>
      </div>
    </nav>