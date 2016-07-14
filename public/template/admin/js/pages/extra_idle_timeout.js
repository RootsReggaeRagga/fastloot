/* ------------------------------------------------------------------------------
*
*  # Session timeout
*
*  Specific JS code additions for extra_session_timeout.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Idle timeout
    $.sessionTimeout({
        heading: 'h5',
        title: 'Idle Timeout',
        message: 'Your session is about to expire. Do you want to stay connected?',
        warnAfter: 5000,
        redirAfter: 15000,
        keepAliveUrl: '/',
        redirUrl: 'http://demo.interface.club/limitless/layout_4/LTR/default/assets/js/pages/login_unlock.html',
        logoutUrl: 'http://demo.interface.club/limitless/layout_4/LTR/default/assets/js/pages/login_advanced.html'
    });
    
});
