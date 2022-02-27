require('./bootstrap');

Echo.private('App.Models.User.' + userId)
    .notification((notification) => {

        const el = `<a href="${notification.url}" class="dropdown-item">
        <!-- Message Start -->
        <div class="media">
          <div class="media-body">
            <p class="text-sm">${notification.data}</p>
          </div>
        </div>
      </a>
      <div class="dropdown-divider"></div>`

      var count = 0;

      if ($('.notification-number').text().length == 0) {
          count = 1;
      }else {
          count = parseInt($('.notification-number').text()) +  1;
      }

      $('.notification-number').text( count );
      $('.notification-wrapper').append( el );
    });
