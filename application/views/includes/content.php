<div class="wcontent">
      <div id="outer-column-container">
        <div id="inner-column-container">
          <div id="page-container">
            <div id="source-order-container">
              <div id="middle-column">
                <div id="mid-top">
                  <div id="mid-top-wrap1">
                    <div id="mid-top-wrap2"></div>
                  </div>
                </div>
                <div id="mid-content-1">
                  <div id="mid-content-2">
                    <div id="mid-content-wrap" class="portlets emptyTop">
                      <div xmlns:fb="http://www.facebook.com/2008/fbml" class="portlet articlePortlet articleOne">
						  
						  <?php
						  $data['data'] = $main_contents_data;
						  $this->load->view($main_content, $data);
						  ?>
					    
                      </div>
                    </div>
                  </div>
                </div>
                
                <div id="mid-bot">
                </div>
              </div>
              <div id="left-column">
				  <?php
				  $data['data'] = $left_contents_data;
				  $this->load->view($left_content, $data);
					
				  ?>
					
              </div>
              <div class="clear-columns"></div>
            </div>
            <!--<div id="right-column">
              <div class="inside">
                <div class="sideportlet userInfoPortlet">
                  <h3>About the author</h3>
                  <div class="avatar">
                    <img src="avatar.jpg" alt="Monika Švaralová" />
                    <p class="userName">Monika Švaralová<br /></p>
                    <em>Authority
			 :
			0</em>
                  </div>
                  <div class="aboutNode"></div>
                </div>
                <div class="sideportlet otherArticlesPortlet">
                  <h3>Other author's posts</h3>
                  <ol>
                    <li>
                      <a href="http://moniq.devblog.matfyz.sk/p98261-introduction-to-bootstrap">Introduction to Bootstrap</a>
                    </li>
                    <li>
                      <a href="http://moniq.devblog.matfyz.sk/p93769-hello-world">Hello world!</a>
                    </li>
                  </ol>
                </div>
              </div>
            </div>
            -->
            <div class="clear-columns"></div>
          </div>
        </div>
      </div>
      <div class="clear"></div>
    </div>
     <div id='footer'>Icons made by <a href="http://www.freepik.com" title="Freepik">Freepik</a> from <a href="http://www.flaticon.com/free-icon/homework_5121" title="Flaticon">www.flaticon.com</a></div>
                





</body>
</html>
