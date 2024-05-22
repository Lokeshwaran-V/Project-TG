// Code for switching between tabs in dashboard

function showDashboard(activeDashboardId) {
    // List of all dashboard IDs
    var dashboards = [
        'admin-dashboard-content',
        'timetable-dashboard-content',
        'faculty-timetable-dashboard-content',
        'subjects-dashboard-content',
        'rooms-dashboard-content'
    ];

    // Loop through all dashboards and set them to 'none' except the active one
    dashboards.forEach(function(dashboardId) {
        var dashboard = document.getElementById(dashboardId);
        if (dashboard) {
            dashboard.style.display = (dashboardId === activeDashboardId) ? 'block' : 'none';
        }
    });
}

// Add event listeners
document.getElementById("admin-page-link").addEventListener("click", function(event) {
    event.preventDefault();
    showDashboard('admin-dashboard-content');
});

document.getElementById("faculty-page-link").addEventListener("click", function(event) {
    event.preventDefault();
    showDashboard('timetable-dashboard-content');
});

document.getElementById("faculty-timetable-link").addEventListener("click", function(event) {
    event.preventDefault();
    showDashboard('faculty-timetable-dashboard-content');
});

document.getElementById("subjects-page-link").addEventListener("click", function(event) {
    event.preventDefault();
    showDashboard('subjects-dashboard-content');
});
document.getElementById("rooms-page-link").addEventListener("click", function(event) {
    event.preventDefault();
    showDashboard('rooms-dashboard-content');
});
