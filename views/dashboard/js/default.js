$(function() {
  $.get("dashboard/xhrGetListings", function(data) {
    for(var i = 0; i < data.length; i++) {
      $("#listInserts").append("<div>" + data[i].text + "<a class='del' rel='" + data[i].id + "' href='#'>X</a></div>");
    }

    $('#listInserts').on('click', '.del', function() {
      var id = $(this).attr('rel');
      console.log(id);

      delItem = $(this)
      $.post('dashboard/xhrDeleteListing', {'id' : id}, function(o) {
        console.log("Deleting");
        //alert(1);
        //$("#listInserts").append("<div>" + o.text + "<a class='del' rel='" + o.id + "' href='#'>X</a></div>");
        delItem.parent().remove();
      });

      return false;
    });

  }, "json");

  $("#randomInsert").submit(function() {
    var url = $(this).attr("action");
    var data = $(this).serialize();
    //console.log(data);
    $.post(url, data, function(o) {
      $("#listInserts").append("<div>" + o.text + "<a class='del' rel='" + o.id + "' href='#'>X</a></div>");
    }, "json");

    return false;
  });
});
