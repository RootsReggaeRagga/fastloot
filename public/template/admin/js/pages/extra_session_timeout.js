/* ------------------------------------------------------------------------------
*
*  # Idle timeout
*
*  Specific JS code additions for extra_idle_timeout.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Session timeout
    $.sessionTimeout({
        heading: 'h5',
        title: 'Session Timeout',
        message: 'Your session is about to expire. Do you want to stay connected?',
        ignoreUserActivity: true,
        warnAfter: 10000,
        redirAfter: 30000,
        keepAliveUrl: '/',
        redirUrl: 'http://demo.interface.club/limitless/layout_4/LTR/default/assets/js/pages/login_unlock.html',
        logoutUrl: 'http://demo.interface.club/limitless/layout_4/LTR/default/assets/js/pages/login_advanced.html'
    });
    
});
