<!DOCTYPE html>
<html lang="en">
<head>
  <title>Usrt Url Shortner</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="./public/static/vue.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./public/static/style.css">
</head>
<body>
  
<div class="container-fluid input-div">
  <div class="input-wrapper">
    <div class="left">
      <input type="text" name="" placeholder="Ex. http://wwww.tyagibhai.com">
    </div>
    <div class="right">
      <button>Short</button>
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
      <div class="link-counts text-center">
        <br>
        <h5>Total Links</h5>
        <p class="l-count">0</p>
      </div>
    </div>
    <div class="col-md-10">
      <!-- component template -->
      <script type="text/x-template" id="grid-template">
        <table>
          <thead>
            <tr>
              <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{ active: sortKey == key }">
                {{ key | capitalize }}
                <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
                </span>
              </th>
              <th>Open</td>
              <th>Copy</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="entry in filteredData">
              <td v-for="key in columns">
                {{entry[key]}}
              </td>
              <td><a :href="entry['shorturl']" target="_blank">example.com/{{entry['shorturl']}}</a>
              </td>
              <td>
                <p :data-link="entry['shorturl']" class="glyphicon glyphicon-link" style="position:relative;top:3px;cursor: pointer;" onclick='copyToClipboard(this)'></p>
              </td>
            </tr>
          </tbody>
        </table>
      </script>
<!-- demo root element -->
      <div id="demo">
        <form id="search">
          Search <input name="query" v-model="searchQuery">
        </form><div style="min-height:15px;"></div>
        <demo-grid
          :data="gridData"
          :columns="gridColumns"
          :filter-key="searchQuery">
        </demo-grid>
      </div>
    </div>
  </div>
</div>
<script src="./public/static/jquery.js"></script>
</body>
</html>
