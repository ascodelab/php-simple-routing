function createTable(l){
      Vue.component('demo-grid', {
      template: '#grid-template',
      props: {
        data: Array,
        columns: Array,
        filterKey: String
      },
      data: function () {
        var sortOrders = {}
        this.columns.forEach(function (key) {
          sortOrders[key] = 1
        })
        return {
          sortKey: '',
          sortOrders: sortOrders
        }
      },
      computed: {
        filteredData: function () {
          var sortKey = this.sortKey
          var filterKey = this.filterKey && this.filterKey.toLowerCase()
          var order = this.sortOrders[sortKey] || 1
          var data = this.data
          if (filterKey) {
            data = data.filter(function (row) {
              return Object.keys(row).some(function (key) {
                return String(row[key]).toLowerCase().indexOf(filterKey) > -1
              })
            })
          }
          if (sortKey) {
            data = data.slice().sort(function (a, b) {
              a = a[sortKey]
              b = b[sortKey]
              return (a === b ? 0 : a > b ? 1 : -1) * order
            })
          }
          return data
        }
      },
      filters: {
        capitalize: function (str) {
          return str.charAt(0).toUpperCase() + str.slice(1)
        }
      },
      methods: {
        sortBy: function (key) {
          this.sortKey = key
          this.sortOrders[key] = this.sortOrders[key] * -1
        }
      }
    })

    // bootstrap the demo
    var demo = new Vue({
      el: '#demo',
      data: {
        searchQuery: '',
        gridColumns: ['longurl','clicked','date'],
        gridData:l
      }
    })
}

//Jquery start
//Table render function
function renderTable(){
      $.get("http://localhost/usrt/?get=1",function(data){
      createTable($.parseJSON(data));
      $(".l-count").html($.parseJSON(data).length);
    }); 
}
//Render table on load
renderTable();
//Validating url
function isUrlValid(url) {
    return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}
//Adding data to the table
$("button").on("click",function(){
   var url=$("input").val();
   if(!isUrlValid(url)){
    alert("not a valid url");
    return false;
   }
   $.ajax({
      url:"http://localhost/usrt/",
      type:"post",
      data:{longurl:url},
      success:function(data){
        $(".l-count").html(($(".l-count").text())*1 +1);
        var rx=$.parseJSON(data);
        console.log(rx);
        var str="<tr><td>"+rx['longurl']+"</td><td>"+rx['clicked']+"</td><td>"+rx['date']+"</td><td><a target='_blank' href='"+rx['shorturl']+"'>example.com/"+rx['shorturl']+"</a></td><td><p class='glyphicon glyphicon-link ctcb' data-link='"+rx['shorturl']+"' onclick='copyToClipboard(this)' style='position:relative;top:3px;cursor: pointer;'></p></td></tr>";
        $("table").append(str);
      }
   });
});
//Copy to clip board
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val("localhost/usrt/"+$(element).data('link')).select();
    document.execCommand("copy");
    $temp.remove();
    alert("Link copied to clipboard");
}
//Jquery ends
