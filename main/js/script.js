let toggleBtn = document.getElementById('toggle-btn');
let body = document.body;
let darkMode = localStorage.getItem('dark-mode');

const enableDarkMode = () =>{
    toggleBtn.classList.replace('fa-sun', 'fa-moon');
    body.classList.add('dark');
    localStorage.setItem('dark-mode', 'enabled');
}

const disableDarkMode = () =>{
    toggleBtn.classList.replace('fa-moon', 'fa-sun');
    body.classList.remove('dark');
    localStorage.setItem('dark-mode', 'disabled');
}

if(darkMode === 'enabled'){
    enableDarkMode();
}

toggleBtn.onclick = (e) =>{
    darkMode = localStorage.getItem('dark-mode');
    if(darkMode === 'disabled'){
        enableDarkMode();
    }else{
        disableDarkMode();
    }
}

let profile = document.querySelector('.header .flex .profile');

document.querySelector('#user-btn').onclick = () =>{
    profile.classList.toggle('active');
    search.classList.remove('active');
}

let search = document.querySelector('.header .flex .search-form');

document.querySelector('#search-btn').onclick = () =>{
    search.classList.toggle('active');
    profile.classList.remove('active');
}

let sideBar = document.querySelector('.side-bar');

document.querySelector('#menu-btn').onclick = () =>{
    sideBar.classList.toggle('active');
    body.classList.toggle('active');
}

document.querySelector('#close-btn').onclick = () =>{
    sideBar.classList.remove('active');
    body.classList.remove('active');
}

window.onscroll = () =>{
    profile.classList.remove('active');
    search.classList.remove('active');

    if(window.innerWidth < 1200){
        sideBar.classList.remove('active');
        body.classList.remove('active');
    }
}
let schedule_form = document.querySelector('.schedule_form');
let schedule_form_detail = document.querySelector('.schedule_form_detail');
let container = document.querySelector('.container');
let schedule = document.querySelector('.schedule_content');
let header = document.querySelector('.header');
document.querySelector('#openPageBtn').onclick = () =>{
    schedule_form.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    // container.classList.toggle('active');
}
document.querySelector('#close_btn').onclick = () => {
    schedule_form.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    // container.classList.toggle('active');
}
document.querySelector('#close_btn_detail').onclick = () => {
    schedule_form_detail.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    // container.classList.toggle('active');
}
function showSchedule(data){
    var start_time_object = document.getElementById('start_time_detail');
    var end_time_object = document.getElementById('end_time_detail');
    var subject_object = document.getElementById('subject_detail');
    var schedule_id_object = document.getElementById('schedule_id_detail');
    var subject_content = document.getElementById('subject_content_detail');
    var schedule_id = document.getElementById('schedule_id');
    var date_object = document.getElementById('date_detail');
    var attendance_object = document.getElementById('attendance_select');
    var main_teacher_object = document.getElementById('main_teacher_detail');
    var status_object = document.getElementById('status_detail');
    var save_button = document.getElementById('save_button_detail');
    var jsonString = data.event._def.extendedProps.attendance_list.replace(/^"|"$/g, '').replace(/\\"/g, '"');
    var jsonArray = JSON.parse(jsonString);

    $("#attendance_select").multipleSelect("setSelects", jsonArray);

    var start = data.event._def.extendedProps.start_time;
    var start_val = start.split(" ")[1];
    var end = data.event._def.extendedProps.end_time;
    // var att = data.event._def.extendedProps.attendance_list;
    var end_val = end.split(" ")[1];
    var date = start.split(" ");
    date = date[0];
// Đặt giá trị cho select
    main_teacher_object.innerHTML = data.event._def.extendedProps.main_teacher;
    subject_content.value = data.event._def.extendedProps.description; // Giá trị muốn đặt
    start_time_object.value = start_val;
    end_time_object.value = end_val;
    subject_object.value = data.event._def.extendedProps.subject_name;
    schedule_id.value = data.event._def.extendedProps.schedule_id;
    date_object.value = date;
    if(data.event._def.extendedProps.status == 1){
        status_object.value = "Đã hoàn thành";
        save_button.disabled = true;
    }
    else{
        status_object.value = "Chưa hoàn thành";
        save_button.disabled = false;
    }

    //render form
    schedule_form_detail.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    // container.classList.toggle('active');
}
// Lấy form theo ID
// var form = document.querySelector('#schedule_form form');
//
// // Lắng nghe sự kiện submit của form
// form.addEventListener('submit', function(event) {
//     // Ngăn chặn hành vi mặc định của form (tải lại trang)
//     event.preventDefault();
//
//     // Lấy giá trị của các trường nhập liệu
//     var startTime = document.querySelector('select[name="start_time"]').value;
//     var endTime = document.querySelector('select[name="end_time"]').value;
//     var subject = document.querySelector('select[name="subject"]').value;
//     var subjectContent = document.querySelector('.subject_content').value;
//     var document = document.querySelector('.document').value;
//     var status = document.querySelector('select[name="status"]').value;
//
//     // Lưu giá trị vào các biến JavaScript
//     var data = {
//         startTime: startTime,
//         endTime: endTime,
//         subject: subject,
//         subjectContent: subjectContent,
//         document: document,
//         status: status
//     };
//
//     // In dữ liệu ra console để kiểm tra
//     console.log(data);
//
//     // Gửi dữ liệu lên server thông qua Ajax (nếu cần)
// });
// Hàm xử lý sự kiện khi nút submit được nhấn
document.querySelector('.submit_btn input[type="submit"]').addEventListener('click', function(event) {
    // Ngăn chặn hành động mặc định của nút submit
    event.preventDefault();
    // Lấy giá trị từ các trường nhập và gán vào các biến
    var startTime = $('#start_time').val();
    var endTime = $('#end_time').val();
    var subject = $('#subject').val();
    var date = $('#date').val();
    var subjectContent = $('#subject_content').val();
    var documentInput = $('#document').val();
    var class_id = document.getElementById('class_id').value;
    var substitute = $('#substitute_checkbox').prop('checked');
    var substitute_teacher= $('#substitute_teacher').val();
    if(substitute === true){
        substitute=1;
    }
    else {
        substitute=0;
    }

    // Tạo một đối tượng hoặc cấu trúc dữ liệu để lưu trữ thông tin
    var data = {
        startTime: startTime,
        endTime: endTime,
        subject: subject,
        date: date,
        subjectContent: subjectContent,
        documentInput: documentInput,
        class_id:class_id,
        substitute:substitute,
        substitute_teacher:substitute_teacher,

    };
    console.log(data);
    $.ajax({
        url: 'ajax_action.php',
        method: "POST",
        data: {
            type: "saveSchedule",
            data: data
        },
        success: function(data) {
            location.reload();
        }
    });
});
// Hàm để định dạng thời gian theo định dạng HH:mm (24 giờ)
function formatDate(date) {
    return date.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: false });
}
document.getElementById("save_button_detail").addEventListener("click", function() {
    // Đây là nơi bạn đặt mã xử lý cho sự kiện khi button "Lưu" được click
    var startTime = $('#start_time_detail').val();
    var endTime = $('#end_time_detail').val();
    var subject = $('#subject_detail').val();
    var date = $('#date_detail').val();
    var subjectContent = $('#subject_content_detail').val();
    var documentInput = $('#document_detail').val();
    var schedule_id = $('#schedule_id').val();
    var class_id = $('#class_id').val();
    var attendance= $('#attendance_select').val();
    // Thêm các hành động xử lý khác tại đây
    var data = {
        startTime: startTime,
        endTime: endTime,
        subject: subject,
        date: date,
        subjectContent: subjectContent,
        documentInput: documentInput,
        schedule_id: schedule_id,
        attendance: attendance,

    };
    console.log(data);
    $.ajax({
        url: 'ajax_action.php',
        method: "POST",
        data: {
            type: "editSchedule",
            data: data
        },
        success: function(data) {
            location.reload();
        }
    });
});
document.getElementById("delete_button_detail").addEventListener("click", function() {
    var schedule_id = $('#schedule_id').val();
    // Thêm các hành động xử lý khác tại đây
    var data = {
        schedule_id: schedule_id,
    };
    console.log(data);
    $.ajax({
        url: 'ajax_action.php',
        method: "POST",
        data: {
            type: "deleteSchedule",
            data: data
        },
        success: function(data) {
            location.reload();
        }
    });
});
document.getElementById('substitute_checkbox').addEventListener('click', function() {
    var select = document.getElementById('substitute_teacher');
    // Nếu checkbox được chọn
    if (this.checked) {
        select.disabled = false; // Enable select
    } else {
        select.disabled = true; // Disable select
    }
});
$("#attendance_select").multipleSelect({
    filter: true
});





