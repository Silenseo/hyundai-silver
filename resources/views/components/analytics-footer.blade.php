<!-- Streamwood Service -->
{{-- <script src="https://static.streamwood.ru/v1/widget.js"></script>
<script>(function($config,$app){$app.run();})(window.__streamwood.Config,window.__streamwood.App);</script> --}}
<!-- Streamwood Service End-->

<script type="text/javascript">
  (function(w, p) {
    var a, s;
    (w[p] = w[p] || []).push(
      "uid=45141",
      "site="+encodeURIComponent(window.location.href)
    );
    a = document.createElement('script'); a.type = 'text/javascript'; a.async = true;	a.charset='utf-8';
    a.src = 'https://panel.smartpoint.pro/collectwidgets/?'+window.SMP_params.join('&');
    s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(a, s);
  })(window, 'SMP_params');
  </script>
  <!-- YAGLA -->
  <script src='//st.yagla.ru/js/y.c.js'></script>
  <!-- /YAGLA -->
  
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    (function (d, w, c) {
      (w[c] = w[c] || []).push(function() {
        try {
          w.yaCounter23837194 = new Ya.Metrika({id:23837194,
            webvisor:true,
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true});
        } catch(e) { }
      });
  
      var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
      s.type = "text/javascript";
      s.async = true;
      s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
  
      if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
      } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
  </script>
  <noscript><div><img src="//mc.yandex.ru/watch/23837194" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
  <!-- /Yandex.Metrika counter -->
  
  <!-- StreamWood code -->
  {{-- <link href="https://clients.streamwood.ru/StreamWood/sw.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="https://clients.streamwood.ru/StreamWood/sw.js" charset="utf-8"></script>
  <script type="text/javascript">
    swQ(document).ready(function(){
      swQ().SW({
        swKey: '0f69f766b0e791190d856ab6538d34b8',
        swDomainKey: '709b4def06e04d1570f005a1d17f4465',
      appEvents: {
              onfirstmessagesend: function(data) {
                  var fio = '', phone = '', mail = '', sub = 'Обращение SteamWood';
                  if (!!data['swClientName']) { fio = data['swClientName']} ;
                  if (!!data['swPhone']) { phone = data['swPhone']} ;
                  if (!!data['swEmail']) { mail = data['swEmail']} ;
                  if (!!data['swFormType']) { sub = 'Заявка SteamWood ' + data['swFormType'] };
          if (!data['swPhone']&&!!data['swEmail']&&data['swEmail'].indexOf('@')== -1) {phone = data['swEmail']; mail = ''}
                  jQuery.getJSON('https://api-node9.calltouch.ru/calls-service/RestAPI/requests/27880/register/', {
                      subject: sub,
                      fio: fio,
                      phoneNumber: phone,
                      email: mail,
                      sessionId: window.call_value
                  });
                  console.log(data);
              }
          }
      });
      swQ('body').SW('load');
    });
  </script> --}}
  <!-- /StreamWood code -->
  
  <!-- Callkeeper -->
  <script type="text/javascript" src="//callkeeper.ru/modules/widget/db/?callkeeper_code=a707849c6247a1764114dbe5ae164a10" charset="UTF-8"></script>
  <script type="text/javascript" src="//callkeeper.ru/modules/widget/callkeeper.js" charset="UTF-8"></script>
  <!-- /Callkeeper -->
  
  <!-- Google Analytics -->
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
    ga('create', 'UA-59830368-1', 'auto');
    ga('send', 'pageview');
  </script>
  <!-- /Google Analytics -->
  
  <!-- Tradeins -->
  <script>
    var script = document.createElement("script");
    script.setAttribute("src", "https://tradeins.ru/lightwidget.js?token=a3743d8c47f4dbb222ae");
    document.head.appendChild(script);
  </script>
  <!-- /Tradeins -->
  
  <!-- Targetix Pixel -->
  <script>
    window._txq = window._txq || [];
    var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//st.targetix.net/txsp.js';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(s);
    _txq.push(['createPixel', '57ac60307bc72f54e416f90a']);
    _txq.push(['track', 'PageView']);
  </script>
  <!-- /Targetix Pixel -->
  
  <!-- calltouch -->
  <script src="https://mod.calltouch.ru/init.js?id=bluawumz"></script>
  <!-- /calltouch -->
  
  <script src="//cdn.callibri.ru/callibri.js" type="text/javascript" charset="utf-8"></script>
