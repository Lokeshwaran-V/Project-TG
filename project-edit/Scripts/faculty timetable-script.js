// Function to toggle dropdown content visibility for faculty dropdown
function toggleFacultyDropdown(dropdownId) {
    var dropdownContent = document.getElementById(dropdownId);
    dropdownContent.classList.toggle("show");
}

// Function to select faculty
function selectFaculty(faculty) {
    var facultyBtn = document.getElementById("dropdown-btn-faculty");
    facultyBtn.innerText = faculty;
    toggleDropdown("dropdown-content-faculty");
    document.getElementById("selected-faculty-timetable").innerText = "Selected Faculty: " + faculty;
}

// Function to select year
function selectYear(year) {
    var yearBtn = document.getElementById("dropdown-btn-year-timetable");
    yearBtn.innerText = year;
    toggleDropdown("dropdown-content-year-timetable");
    document.getElementById("selected-year-timetable").innerText = "Selected Year: " + year;
}

// Function to select department
function selectDepartment(department) {
    var departmentBtn = document.getElementById("dropdown-btn-department-timetable");
    departmentBtn.innerText = department;
    toggleDropdown("dropdown-content-department-timetable");
    document.getElementById("selected-department-timetable").innerText = "Selected Department: " + department;
}

// Function to view timetable
function viewTimetable() {
    var selectedFaculty = document.getElementById("selected-faculty-timetable").innerText.split(": ")[1];
    var selectedYear = document.getElementById("selected-year-timetable").innerText.split(": ")[1];
    var selectedDepartment = document.getElementById("selected-department-timetable").innerText.split(": ")[1];

    console.log("Viewing timetable for Faculty:", selectedFaculty, "Year:", selectedYear, "Department:", selectedDepartment);
}
