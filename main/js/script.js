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
let container = document.querySelector('.container');
let schedule = document.querySelector('.schedule_content');
let header = document.querySelector('.header');
document.querySelector('#openPageBtn').onclick = () =>{
    schedule_form.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    container.classList.toggle('active');
}
document.querySelector('#close_btn').onclick = () => {
    schedule_form.classList.toggle('active');
    schedule.classList.toggle('blur');
    sideBar.classList.toggle('blur');
    header.classList.toggle('blur');
    container.classList.toggle('active');
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

    // Tạo một đối tượng hoặc cấu trúc dữ liệu để lưu trữ thông tin
    var formData = {
        startTime: startTime,
        endTime: endTime,
        subject: subject,
        date: date,
        subjectContent: subjectContent,
        documentInput: documentInput
    };

    console.log(formData);

    $.ajax({
        url: 'ajax_action.php',
        method: "POST",
        data: { formData: formData },
        success: function(data) {
            location.reload();
        }
    });
});


