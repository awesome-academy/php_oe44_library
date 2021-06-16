var pusher = new Pusher(key, {
    encrypted: true,
    cluster: "ap1"
});
var channel = pusher.subscribe('NotificationEvent');
channel.bind('send-message', function(data) {
    var newNotificationHtml = `
    <a class="dropdown-item card @if(!Auth::user()->notifications[$i]->read_at) read @endif" href="${data.link}">
        <h5 class="card-title">${data.title}</h5>
        <p class="card-text">${data.content}</p>
        <p class="card-text">${data.time}</p>
    </a>
    `;
    $('.menu-notification').prepend(newNotificationHtml);
    $('.modal-body').prepend(newNotificationHtml);
    count = count + 1
    document.getElementById('count-notification').innerHTML = count
});

$('#navbarDropdown').click(function(){ 
    count = 0
    document.getElementById('count-notification').innerHTML = count
    var _token = $('input[name="_token"]').val(); 
    $.ajax({
        url:"/notification", 
        method:"POST", 
        data:{ _token:_token},
        success:function(data){ }
    });
});
