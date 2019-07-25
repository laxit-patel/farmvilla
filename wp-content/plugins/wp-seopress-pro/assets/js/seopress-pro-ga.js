//Request Google Analytics
jQuery(document).ready(function(){
    //Tabs
    jQuery("#seopress-tabs2 .hidden").removeClass('hidden');
    jQuery("#seopress-tabs2").tabs();

    //Ajax
    jQuery( '.spinner' ).css( "visibility", "visible" );
    jQuery( '.spinner' ).css( "float", "none" );
    jQuery.ajax({
        method : 'GET',
        url : seopressAjaxRequestGoogleAnalytics.seopress_request_google_analytics,
        data : {
            action: 'seopress_request_google_analytics',
            _ajax_nonce: seopressAjaxRequestGoogleAnalytics.seopress_nonce,
        },

        success : function( data ) {
            if ( data.success ) {                               
                jQuery( '#seopress-ga-sessions' ).html(data.data.sessions);
                jQuery( '#seopress-ga-users' ).html(data.data.users);
                jQuery( '#seopress-ga-pageviews' ).html(data.data.pageviews);
                jQuery( '#seopress-ga-pageviewsPerSession' ).html(data.data.pageviewsPerSession);
                jQuery( '#seopress-ga-avgSessionDuration' ).html(data.data.avgSessionDuration);
                jQuery( '#seopress-ga-bounceRate' ).html(data.data.bounceRate + '%');
                jQuery( '#seopress-ga-percentNewSessions' ).html(data.data.percentNewSessions + '%');
                
                jQuery( '#sp-tabs-2' ).load(' #sp-tabs-2');
                jQuery( '#sp-tabs-3' ).load(' #sp-tabs-3');
                jQuery( '#sp-tabs-4' ).load(' #sp-tabs-4');
                jQuery( '#sp-tabs-5' ).load(' #sp-tabs-5');

                
                //Graph
                var data = {
                    labels: data.data.sessions_graph_labels,
                    datasets: [
                        {
                            label: data.data.sessions_graph_title,
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "#9ED8FF",
                            borderColor: "#2C97DF",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "#2C97DF",
                            pointBackgroundColor: "#9ED8FF",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#9ED8FF",
                            pointHoverBorderColor: "#2C97DF",
                            pointHoverBorderWidth: 2,
                            pointRadius: 2,
                            pointHitRadius: 10,
                            data: data.data.sessions_graph_data,
                            spanGaps: false,
                        }
                    ]
                };
                var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: {
                        scales: {
                            xAxes: [{
                                display: false
                            }]
                        }
                    }
                });
            }
        },
        complete: function(){
            jQuery('#seopress-request-google-analytics').removeAttr("disabled");
            jQuery( '.spinner' ).css( "visibility", "hidden" );
        }
    });
});