<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <style>
      table {
         width: 100%;
         padding: 0;
         margin:0px;
      }
      td {
        margin: 0;
        width: 100%;
        padding: 25px;
      }
      a {
         color: #3869D4;
         font-size: 12px;
         font-weight: bold;
         text-decoration: none;
      }
      body{
        width: 100%;
        color: #74787E;
        font-family: Avenir, Helvetica, sans-serif;
        line-height: 1;
        margin: 0;
      }
      h1 {
        font-size: 19px;
        font-weight: bold;
        margin-top: 0;
        text-align: left;
      }
      p {
        color: #74787E;
        margin-top: 0;
        font-size: 13px;
        line-height: 1.5em;
        text-align: left;
      }
      .header, .footer {
        background-color: #d9e2e8;
      }
      .inner-body {
        max-width: 500px;
        margin: 0 auto;
      }
      h1, h5 {
          color: #252422;
       }
       @media  only screen and (max-width: 600px) {
         a {
           font-size: 13px;
          }
       }
      </style>
   </head>
   <body>
      <table class="wrapper">
         <tr>
             <td class="header" style="text-align:center">
                <a href="http://shopify-store.co" style="font-size:19px;">Shopify store</a>
              </td>
          </tr>
            <!-- Email Body -->
         <tr>
            <td class="body" style="">
               Dear, {{ $order['customer_name']}}.
            </td>
          </tr>
         <tr>
            <td class="body" style="">
               Your Order number <strong>{{$order['order_id']}}</strong> is {{ $status }}
            </td>
          </tr>
           <td class="footer" >
               <p style="text-align:center;">© 2018 Shopify. All rights reserved.</p>
           </td>
          </tr>
      </table>
   </body>
</html>
