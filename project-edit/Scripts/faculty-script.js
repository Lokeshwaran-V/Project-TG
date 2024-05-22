// Function to toggle dropdown content visibility
function toggleFacultyDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId);
    dropdownContent.classList.toggle("show");
}

// Function to select department in faculty dashboard
function selectFacultyDepartment(department) {
    var departmentBtn = document.getElementById("faculty-dropdown-btn-department");
    departmentBtn.innerText = department;
    toggleFacultyDropdown("faculty-dropdown-content-department");
    document.getElementById("faculty-selected-department").innerText = "Selected Department: " + department;
}

// Function to select year in faculty dashboard
function selectFacultyYear(year) {
    var yearBtn = document.getElementById("faculty-dropdown-btn-year");
    yearBtn.innerText = year;
    toggleFacultyDropdown("faculty-dropdown-content-year");
    document.getElementById("faculty-selected-year").innerText = "Selected Year: " + year;
}

// Function to view timetable in faculty dashboard
function viewFacultyTimetable() {
    var selectedDepartment = document.getElementById("faculty-selected-department").innerText.split(": ")[1];
    var selectedYear = document.getElementById("faculty-selected-year").innerText.split(": ")[1];

    console.log("Viewing timetable for Department:", selectedDepartment, "Year:", selectedYear);
}
