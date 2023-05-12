 // Handle form submission
 $('#search-form').submit(function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Get search query and category
    var query = $('#search').val();
    var category = $('#category').val();

    // Build API URL
    var apiUrl = 'https://pixabay.com/api/?key=13119377-fc7e10c6305a7de49da6ecb25';
    if (query !== '') {
        apiUrl += '&q=' + encodeURIComponent(query);
    }
    if (category !== '') {
        apiUrl += '&category=' + encodeURIComponent(category);
    }
 
    // Send AJAX request to API
    $.ajax({
        url: apiUrl,
        dataType: 'jsonp',
        success: function(data) {
            // Clear previous results
            $('#results').empty();

            // Loop through results and create HTML
            $.each(data.hits, function(index, hit) {
                var imageUrl = hit.webformatURL;
                var imageAlt = hit.tags;
                var imageViews = hit.views
                var imageLikes = hit.likes
                var imageHtml = '<div class="col-sm-6 col-md-4">' +
                                    '<div class="thumbnail">' +
                                        '<img src="' + imageUrl + '" alt="' + imageAlt + '">' +
                                        '<div class="caption">' +
                                            '<p>' + imageAlt + '</p>  Visitas  ' + imageViews + '<p>  Likes '+ imageLikes +'</p>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>';
                $('#results').append(imageHtml);
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    }
 
    )
 }
 )
