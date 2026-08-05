<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard — CLFS</title>
  <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>

  <div class="shell">

    <!-- ── Sidebar ── -->
    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="brand-icon">🔍</div>
        <div>
          <div class="brand-name">CLFS</div>
          <div class="brand-sub">Bernhardt College</div>
        </div>
      </div>

      <div class="sidebar-user">
        <div class="user-avatar">S</div>
        <div>
          <div class="user-name">Sajan Shrestha</div>
          <div class="user-roll">Roll: 46102193</div>
        </div>
      </div>

      <div class="nav-section-label">Main Menu</div>
      <ul class="nav-list">
        <li><a class="nav-link active" href="#">
            <span class="nav-icon">🏠</span> Dashboard
          </a></li>
        <li><a class="nav-link" href="#">
            <span class="nav-icon">🔎</span> Browse Found Items
          </a></li>

        <li> <a class="nav-link" href="report-lost.php">
            <span class="nav-icon">📋</span> Report Lost Item
          </a></li>
        <li><a class="nav-link" href="#">
            <span class="nav-icon">📦</span> Report Found Item
          </a></li>
      </ul>

      <div class="nav-section-label">My Activity</div>
      <ul class="nav-list">
        <li><a class="nav-link" href="#">
            <span class="nav-icon">📁</span> My Reports
          </a></li>
        <li><a class="nav-link" href="#">
            <span class="nav-icon">🏷️</span> My Claims
            <span class="nav-badge">2</span>
          </a></li>


      </ul>

      <div class="sidebar-footer">
        <div class="logout-btn">
          <span>🚪</span> Logout
        </div>
      </div>
    </aside>

    <!-- ── Main ── -->
    <div class="main">

      <!-- ── Top Bar ── -->
      <header class="topbar">
        <div>
          <span class="topbar-title">Dashboard</span>
          <span class="topbar-sub">— Welcome back, Sajan</span>
        </div>
        <div class="topbar-right">
          <span class="topbar-date">📅 Monday, 14 July 2025</span>
          <div class="notif-btn">
            🔔
            <div class="notif-dot"></div>
          </div>
        </div>
      </header>

      <!-- ── Content ── -->
      <div class="content">

        <!-- Welcome Banner -->
        <div class="welcome-banner">
          <div class="welcome-emoji">👋</div>
          <div class="welcome-text">
            <h2>Good morning, Sajan!</h2>
            <p>You have 2 pending claims and 3 new notifications. Check your activity below.</p>
          </div>
          <div class="welcome-actions">
            <a class="btn btn-white" href="report-lost.php">📋 Report Lost</a>
            <a class="btn btn-outline" href="#">📦 Report Found</a>
          </div>
        </div>

        <!-- Stats -->
        <div class="stat-grid">
          <div class="stat-card c-amber">
            <div class="stat-icon-wrap ic-amber">🔍</div>
            <div>
              <div class="stat-num">2</div>
              <div class="stat-lbl">Lost Reports</div>
              <div class="stat-sub">1 active · 1 resolved</div>
              <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width:50%;background:var(--amber)"></div>
              </div>
            </div>
          </div>
          <div class="stat-card c-teal">
            <div class="stat-icon-wrap ic-teal">📦</div>
            <div>
              <div class="stat-num">1</div>
              <div class="stat-lbl">Found Reports</div>
              <div class="stat-sub">Deposited in box</div>
              <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width:100%;background:var(--teal)"></div>
              </div>
            </div>
          </div>
          <div class="stat-card c-sky">
            <div class="stat-icon-wrap ic-sky">🏷️</div>
            <div>
              <div class="stat-num">2</div>
              <div class="stat-lbl">Claim Requests</div>
              <div class="stat-sub">2 pending review</div>
              <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width:66%;background:var(--sky)"></div>
              </div>
            </div>
          </div>
          <div class="stat-card c-rose">
            <div class="stat-icon-wrap ic-rose">🔔</div>
            <div>
              <div class="stat-num">3</div>
              <div class="stat-lbl">Notifications</div>
              <div class="stat-sub">3 unread</div>
              <div class="progress-bar-wrap">
                <div class="progress-bar-fill" style="width:100%;background:var(--rose)"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Two Column: Recent Items + Quick Actions -->
        <div class="two-col">

          <!-- Recent Found Items -->
          <div class="panel">
            <div class="section-head">
              <div class="section-title">🗂 Recent Found Items</div>
              <a class="see-all" href="#">Browse all →</a>
            </div>
            <div class="items-list">
              <div class="item-card">
                <div class="item-img">👜</div>
                <div class="item-info">
                  <div class="item-name">Black Leather Wallet</div>
                  <div class="item-meta">
                    <span class="item-loc">Library</span>
                    <span class="item-date">10 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-found">Found</span>
              </div>
              <div class="item-card">
                <div class="item-img">📱</div>
                <div class="item-info">
                  <div class="item-name">Samsung Mobile Phone</div>
                  <div class="item-meta">
                    <span class="item-loc">Canteen</span>
                    <span class="item-date">9 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-found">Found</span>
              </div>
              <div class="item-card">
                <div class="item-img">🔑</div>
                <div class="item-info">
                  <div class="item-name">Key Bundle (3 keys)</div>
                  <div class="item-meta">
                    <span class="item-loc">Classroom 201</span>
                    <span class="item-date">8 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-found">Found</span>
              </div>
              <div class="item-card">
                <div class="item-img">🎒</div>
                <div class="item-info">
                  <div class="item-name">Blue Backpack</div>
                  <div class="item-meta">
                    <span class="item-loc">Parking Area</span>
                    <span class="item-date">7 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-found">Found</span>
              </div>
            </div>
          </div>

          <!-- Quick Actions + Notifications -->
          <div style="display:flex;flex-direction:column;gap:18px;">

            <!-- Quick Actions -->
            <div class="panel">
              <div class="section-head">
                <div class="section-title">⚡ Quick Actions</div>
              </div>
              <div class="quick-actions">
                <a class="qa-btn q-lost" href="#">
                  <span class="qa-icon">🔍</span>
                  <div>
                    <div class="qa-label">Report Lost Item</div>
                    <div class="qa-sub">Something missing?</div>
                  </div>
                  <span class="qa-arrow">›</span>
                </a>
                <a class="qa-btn q-found" href="#">
                  <span class="qa-icon">📦</span>
                  <div>
                    <div class="qa-label">Report Found Item</div>
                    <div class="qa-sub">Hand it to the box</div>
                  </div>
                  <span class="qa-arrow">›</span>
                </a>
                <a class="qa-btn q-browse" href="#">
                  <span class="qa-icon">🗂</span>
                  <div>
                    <div class="qa-label">Browse Found Items</div>
                    <div class="qa-sub">Search all active items</div>
                  </div>
                  <span class="qa-arrow">›</span>
                </a>
                <a class="qa-btn q-claims" href="#">
                  <span class="qa-icon">🏷️</span>
                  <div>
                    <div class="qa-label">My Claims</div>
                    <div class="qa-sub">2 pending approval</div>
                  </div>
                  <span class="qa-arrow">›</span>
                </a>
              </div>
            </div>

            <!-- Notifications -->
            <div class="panel">
              <div class="section-head">
                <div class="section-title">🔔 Notifications</div>
                <a class="see-all" href="#">View all</a>
              </div>
              <div class="notif-list">
                <div class="notif-item">
                  <div class="notif-dot-icon nd-teal">✅</div>
                  <div style="flex:1">
                    <div class="notif-msg"><strong>Claim Approved!</strong> Your claim for "Black Wallet" has been
                      approved.</div>
                    <div class="notif-time">2 hours ago</div>
                  </div>
                  <div class="unread-dot"></div>
                </div>
                <div class="notif-item">
                  <div class="notif-dot-icon nd-amber">🔍</div>
                  <div style="flex:1">
                    <div class="notif-msg">A new item matching your lost report <strong>"Calculator"</strong> was found.
                    </div>
                    <div class="notif-time">Yesterday</div>
                  </div>
                  <div class="unread-dot"></div>
                </div>
                <div class="notif-item">
                  <div class="notif-dot-icon nd-rose">❌</div>
                  <div style="flex:1">
                    <div class="notif-msg">Your claim for <strong>"Blue Bag"</strong> was rejected. See reason.</div>
                    <div class="notif-time">2 days ago</div>
                  </div>
                  <div class="unread-dot"></div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Bottom Row -->
        <div class="bottom-row">

          <!-- My Claims -->
          <div class="panel">
            <div class="section-head">
              <div class="section-title">🏷️ My Claim Requests</div>
              <a class="see-all" href="#">View all</a>
            </div>
            <table class="claim-table">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Date</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div class="claim-item-name">Black Leather Wallet</div>
                    <div style="font-size:11px;color:var(--text-3)">Category: Wallet</div>
                  </td>
                  <td>10 Jul 2025</td>
                  <td><span class="item-badge badge-approved">Approved</span></td>
                </tr>
                <tr>
                  <td>
                    <div class="claim-item-name">Samsung Mobile Phone</div>
                    <div style="font-size:11px;color:var(--text-3)">Category: Electronics</div>
                  </td>
                  <td>9 Jul 2025</td>
                  <td><span class="item-badge badge-pending">Pending</span></td>
                </tr>
                <tr>
                  <td>
                    <div class="claim-item-name">Blue Backpack</div>
                    <div style="font-size:11px;color:var(--text-3)">Category: Bag</div>
                  </td>
                  <td>7 Jul 2025</td>
                  <td><span class="item-badge badge-rejected">Rejected</span></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- My Reports -->
          <div class="panel">
            <div class="section-head">
              <div class="section-title">📁 My Reports</div>
              <a class="see-all" href="#">View all</a>
            </div>
            <div class="items-list">
              <div class="item-card">
                <div class="item-img">🧮</div>
                <div class="item-info">
                  <div class="item-name">Scientific Calculator</div>
                  <div class="item-meta">
                    <span class="item-loc">Lab 3</span>
                    <span class="item-date">5 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-lost">Lost</span>
              </div>
              <div class="item-card">
                <div class="item-img">🪪</div>
                <div class="item-info">
                  <div class="item-name">Student ID Card</div>
                  <div class="item-meta">
                    <span class="item-loc">Block B</span>
                    <span class="item-date">1 Jul 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-collected">Resolved</span>
              </div>
              <div class="item-card">
                <div class="item-img">📗</div>
                <div class="item-info">
                  <div class="item-name">Green Notebook</div>
                  <div class="item-meta">
                    <span class="item-loc">Canteen</span>
                    <span class="item-date">28 Jun 2025</span>
                  </div>
                </div>
                <span class="item-badge badge-found">Found</span>
              </div>
            </div>
          </div>

        </div>
      </div><!-- /content -->
    </div><!-- /main -->
  </div><!-- /shell -->

  <script>
    // Animate progress bars on load
    window.addEventListener('load', () => {
      document.querySelectorAll('.progress-bar-fill').forEach(bar => {
        const w = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => { bar.style.width = w; }, 200);
      });
    });

    // Nav active state
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });
  </script>
</body>

</html>