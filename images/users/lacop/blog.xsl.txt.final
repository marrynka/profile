<?xml version="1.0" encoding="utf-8"?>

<xsl:stylesheet
  version="1.0"
  xmlns:exsl="http://exslt.org/common"  
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  exclude-result-prefixes="exsl"
>
<xsl:output
  method="xml"
  version="1.0"
  encoding="utf-8"
  doctype-public="-//W3C//DTD XHTML 1.0 Strict//EN"
  doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"
  omit-xml-declaration="yes"
  indent="yes"
/>


 <!-- URL params
  ! standalone - overrides any other params
  !  * postID - get specified article
  !  * editID - render edit form for specified article
  !  * newpost - render new post form
  !  * archive - render archive view
  !
  ! following can be combined in any way
  !  * year, month, day - filter by specified date params
  !  * tag - filter by specified tag
  !  * order - order by date, asc or desc
  !  * showprivate - show private posts
  -->

<xsl:param name="postID" />
<xsl:param name="editID" />
<xsl:param name="newpost" />
<xsl:param name="archive" />
<xsl:param name="year" />
<xsl:param name="month" />
<xsl:param name="day" />
<xsl:param name="tag" />
<xsl:param name="order" />
<xsl:param name="showprivate" />

<xsl:template match="*|/">
  <xsl:apply-templates/>
</xsl:template>
<xsl:template match="*|/" mode="m">
  <xsl:apply-templates mode="m"/>
</xsl:template>
<xsl:template match="text()|@*">
  <xsl:value-of select="."/>
</xsl:template>

<!--
 ! Main template
 -->
<xsl:template match="/">
  <html lang="en" xml:lang="en">
    <head>
      <title>
        <xsl:choose>
          <xsl:when test="$postID and /user/blog/post/@ID=$postID">
            <xsl:value-of select='/user/blog/post[@ID=$postID]/title' /> -
          </xsl:when>
          <xsl:when test="$newpost">
            New post -
          </xsl:when>
          <xsl:when test="$archive">
            Archive -
          </xsl:when>
        </xsl:choose>
        <xsl:value-of select='/user/blog/title' />
      </title>
      <link href="main.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
      <div id="content-container">
        <div id="header">
          <div id="title">
            <h1><a name="top" href="/"><xsl:value-of select='/user/blog/title' /></a></h1>
          </div>
          <div id="links">
            <a href="/">Home</a><a href="/?archive=1">Archive</a><a href="/?newpost=1">New post</a>
            <xsl:if test="not($postID) and not($newpost) and not($archive)">
              <xsl:if test="$order = 'asc'">
                <a href="?order=desc">Oldest first &#9650;</a>
              </xsl:if>
              <xsl:if test="not($order = 'asc')">
                <a href="?order=asc">Newest first &#9660;</a>
              </xsl:if>
            </xsl:if>
            <xsl:if test="$postID and /user/blog/post/@ID=$postID">
              <a href="/?editID={$postID}">Edit this post</a>
            </xsl:if>
            <div class="clear"></div>
          </div>
        </div> 
        <div id="column-container">
          <div id="posts">
            <xsl:choose>
              <xsl:when test="$postID and /user/blog/post/@ID=$postID">
                <xsl:apply-templates select="/user/blog/post[@ID=$postID]"/>
              </xsl:when>
              <xsl:when test="$editID and /user/blog/post/@ID=$editID">
                <xsl:call-template name="editpost-form" />
              </xsl:when>
              <xsl:when test="$postID or $editID">
                <h2>Sorry, this post doesn't exist</h2>
              </xsl:when>
              <xsl:when test="$newpost">
                <xsl:call-template name="newpost-form" />
              </xsl:when>
              <xsl:when test="$archive">
                <xsl:call-template name="archive" />
              </xsl:when>
              <xsl:when test="$tag">
                <xsl:call-template name="post-list">
                  <xsl:with-param name="filtered" select="/user/blog/post[./tags/tag = $tag]" />
                </xsl:call-template>
              </xsl:when>
              <xsl:otherwise>
                <xsl:call-template name="post-list">
                  <xsl:with-param name="filtered" select="/user/blog/post" />
                </xsl:call-template>
              </xsl:otherwise>
            </xsl:choose>
          </div>
          <div id="sidebar">
            <img id="picture" src="avatar.jpg" alt="photo"/>
            <h2 id="name"><xsl:value-of select='/user/info/realName' /></h2>
            <span id="blog-info">Blog for the <a href="http://webdesign.courses.matfyz.sk/">1-AIN-636</a> Modern Approaches to Web Design class. </span>
            <h3>Tags</h3>
            <ul id="tag-list">
              <xsl:for-each select="//tag[not(preceding::tag = .)]">
                <!-- <xsl:sort select="." /> --> <!-- by name -->
                <xsl:sort select="count(//post[@private = 'no' and count(./tags/tag[current() = .]) &gt; 0])" order="descending" /> <!-- by count -->
                <li><xsl:apply-templates select="." /> (<xsl:value-of select="count(//post[@private = 'no' and count(./tags/tag[current() = .]) &gt; 0])" />)</li>
              </xsl:for-each>
            </ul>
          </div>
        </div>
        <div id="footer">
          <div class="left"><a href="#top">Top</a> <a href="/">Home</a></div>
          <div class="right">Copyright © 2012, <xsl:value-of select='/user/info/realName' /></div>
          <div class="left"><xsl:value-of select="count(/user/blog/post)" />&#xA0;posts,
        <xsl:value-of select="sum(/user/blog/post/@accessCount)" />&#xA0;views</div>
          <div class="right">Header picture: <a href="http://www.flickr.com/photos/fiduz/7676267154/">Rainy Day by Fiduz</a>, CC BY-NC-SA 2.0</div>
          <div class="clear"></div>
        </div>
      </div>
    </body>
  </html>
</xsl:template>

<!--
 ! List of posts - short mode, with proper sorting
 -->
<xsl:template name="post-list">
  <xsl:param name="filtered" />

  <xsl:if test="$order = 'asc'">
    <xsl:apply-templates select="$filtered" mode="short">
        <xsl:sort select="date/@timestamp" order="ascending"/>
    </xsl:apply-templates>
  </xsl:if>
  <xsl:if test="not($order = 'asc')">
    <xsl:apply-templates select="$filtered" mode="short">
        <xsl:sort select="date/@timestamp" order="descending"/>
    </xsl:apply-templates>
  </xsl:if>

</xsl:template>

<!--
 ! Post header - title, subtitle, ...
 !             - full mode - title isn't a link
 -->
<xsl:template name="post-header">
  <xsl:param name="mode" />

  <h2 class="post-title">
    <xsl:if test="$mode = 'full'">
      <xsl:value-of select="title"/>
    </xsl:if>
    <xsl:if test="not($mode = 'full')">
      <a href="http://{/user/info/nick}.blog.matfyz.sk/{@ID}"><xsl:value-of select="title"/></a>
    </xsl:if>
  </h2>
  <xsl:if test="subtitle">
    <h3 class="post-subtitle"><xsl:value-of select="subtitle"/></h3>
  </xsl:if>
  <p>
    <strong>Created: </strong><xsl:apply-templates select="date" mode="pretty" />
    <xsl:if test="lastUpdate">
      (<strong>Updated: </strong><xsl:apply-templates select="lastUpdate" mode="pretty" />)
    </xsl:if>
  </p>
</xsl:template>

<!--
 ! Post footer - short mode - tags, number of views, number of comments
 !             - full mode  - tags, number of views, prev/next, list of comments,
 !                            new comment form
 -->
<xsl:template name="post-footer">
  <xsl:param name="mode" />
  
  <xsl:if test="$mode = 'full'">
    <h2>Article info</h2>
  </xsl:if>
  <h3>Tags</h3>
  <ul>
    <xsl:for-each select=".//tag">
      <li><xsl:apply-templates select="." /></li>
    </xsl:for-each>
  </ul>

  <xsl:if test="$mode = 'full'">
    <h3>Other articles</h3>
    <xsl:if test="$mode = 'full'">
      <xsl:if test="preceding-sibling::post[1]">
        <strong>Previous: </strong><a href="http://{/user/info/nick}.blog.matfyz.sk/{preceding-sibling::post[1]/@ID}"><xsl:value-of select="preceding-sibling::post[1]/title"/></a><br />
       </xsl:if>
       <xsl:if test="following-sibling::post[1]">
          <strong>Next: </strong><a href="http://{/user/info/nick}.blog.matfyz.sk/{following-sibling::post[1]/@ID}"><xsl:value-of select="following-sibling::post[1]/title"/></a>
       </xsl:if>
    </xsl:if>

    <h3>Stats</h3>
  </xsl:if>

  <strong>Viewed <xsl:value-of select="@accessCount" />&#xA0;time(s)</strong><br />
  <strong>Comments: </strong>
  <xsl:if test="comments/comment">
    <xsl:value-of select="count(.//comment)"/>
  </xsl:if>
  <xsl:if test="not(comments/comment)">
    No comments
  </xsl:if>
  <br />

  <xsl:if test="comments/comment and $mode = 'full'">
    <h2>Comments</h2>
    <div class="comments">
      <xsl:apply-templates select="comments/comment"/>
    </div>
  </xsl:if>

  <xsl:if test="$mode = 'full'">
    <xsl:call-template name="comment-form" />
  </xsl:if>

</xsl:template>

<!--
 ! Post - short mode
 ! 
 ! Apply filters - private and archive (tags are already applied in selector)
 -->
<xsl:template match="post" mode="short">
  <xsl:if test="($showprivate or not(@private='yes')) and (not($year) or $year = substring(date, 1, 4)) and (not($month) or $month = substring(date, 6, 2)) and (not($day) or $day = substring(date, 9, 2))">
    <div class="post" lang="{@lang}" xml:lang="{@lang}">
      <xsl:call-template name="post-header">
        <xsl:with-param name="mode" select="'short'" />
      </xsl:call-template>

      <xsl:if test="string-length(content/p[position()=1]) &lt;= 250">
        <xsl:copy-of select="content/p[position()=1]"/>
        <p><a href="http://{/user/info/nick}.blog.matfyz.sk/{@ID}">[read more]</a></p>
      </xsl:if>
      <xsl:if test="string-length(content/p[position()=1]) &gt; 250">
        <p>
          <xsl:value-of select="substring(content/p[position()=1], 0, 250)"/>
          &#8230; <a href="http://{/user/info/nick}.blog.matfyz.sk/{@ID}">[read more]</a>
        </p>
      </xsl:if>
      
      <xsl:call-template name="post-footer">
        <xsl:with-param name="mode" select="'short'" />
      </xsl:call-template>
    </div>
  </xsl:if>
</xsl:template>

<!--
 ! Post - full mode
 ! 
 ! Always show, ignore filtering/private/...
 -->
<xsl:template match="post">
  <div class="post" lang="{@lang}" xml:lang="{@lang}">
    <xsl:call-template name="post-header">
      <xsl:with-param name="mode" select="'full'" />
    </xsl:call-template>

    <xsl:copy-of select="content/*"/>

    <xsl:call-template name="post-footer">
      <xsl:with-param name="mode" select="'full'" />
    </xsl:call-template>
   </div>
</xsl:template>

<!--
 ! Comment template
 -->
<xsl:template match="comment">
   <div class="comment" lang="{@lang}" xml:lang="{@lang}">
     <h4><xsl:value-of select="title" /></h4>
     <strong>By</strong>&#xA0;<xsl:apply-templates select="author/nick"/>&#xA0;<xsl:apply-templates select="date" mode="pretty" />
     <xsl:copy-of select="content/*"/>
     <xsl:if test="comment">
       <div class="comments">
         <xsl:apply-templates select="comment"/>
       </div>
     </xsl:if>
   </div>
</xsl:template>
 
<!--
 ! Comment form
 -->
<xsl:template name="comment-form">
  <h2>Post new comment</h2>
  <form action="?type=commentForm" method="post">
    <fieldset>
      <textarea rows="20" cols="60" name="comment">
&lt;?xml version=&quot;1.0&quot; encoding=&quot;utf-8&quot;?&gt;
&lt;!DOCTYPE comment SYSTEM &quot;comment.dtd&quot;&gt;
&lt;comment lang=&quot;<xsl:value-of select="@lang"/>&quot; ref=&quot;<xsl:value-of select="@ID"/>&quot;&gt;
  &lt;title&gt;TITLE&lt;/title&gt;
  &lt;content&gt;
    &lt;p&gt;CONTENT&lt;/p&gt;
  &lt;/content&gt;
&lt;/comment&gt;
      </textarea>
      <input type="submit" name="submit" class="submit" value="Send!"/>
    </fieldset>
  </form>
</xsl:template>

<!--
 ! New post form
 -->
<xsl:template name="newpost-form">
  <h2>New post</h2>
  <form action="?type=postForm" method="post">
    <fieldset>
      <textarea rows="20" cols="60" name="post">
&lt;?xml version="1.0" encoding="utf-8"?&gt;  
&lt;!DOCTYPE post SYSTEM "post.dtd"&gt;
&lt;post lang="en" private="yes"&gt;
  &lt;title&gt;&lt;/title&gt;
  &lt;subtitle&gt;&lt;/subtitle&gt;
  &lt;content&gt;
    
  &lt;/content&gt;
  &lt;tags&gt;
    &lt;tag&gt; &lt;/tag&gt;
  &lt;/tags&gt;
&lt;/post&gt;
      </textarea>
      <input type="submit" name="submit" class="submit" value="Post"/>
    </fieldset>
  </form>
</xsl:template>

<!--
 ! Edit post form
 -->
<xsl:template name="editpost-form">
  <h2>Editing <a href="http://{/user/info/nick}.blog.matfyz.sk/{$editID}"><xsl:value-of select="/user/blog/post[@ID = $editID]/title"/></a></h2>
  <form action="?type=postForm" method="post">
    <fieldset>
      <textarea rows="20" cols="60" name="post">
&lt;?xml version="1.0" encoding="utf-8"?&gt;  
&lt;!DOCTYPE post SYSTEM "post.dtd"&gt;
&lt;post lang="<xsl:value-of select="/user/blog/post[@ID = $editID]/@lang" />" private="<xsl:value-of select="/user/blog/post[@ID = $editID]/@private" />" ID="<xsl:value-of select="$editID" />"&gt;
  &lt;title&gt;<xsl:value-of select="/user/blog/post[@ID = $editID]/title" />&lt;/title&gt;
  &lt;subtitle&gt;<xsl:value-of select="/user/blog/post[@ID = $editID]/subtitle" />&lt;/subtitle&gt;
  &lt;content&gt;
    <xsl:apply-templates select="/user/blog/post[@ID = $editID]/content/*" mode="copy-escaped"/>
  &lt;/content&gt;
  &lt;tags&gt;<xsl:for-each select="/user/blog/post[@ID = $editID]/tags/tag">
    &lt;tag&gt;<xsl:value-of select="." />&lt;/tag&gt;</xsl:for-each>
  &lt;/tags&gt;
&lt;/post&gt;
      </textarea>
      <input type="submit" name="submit" class="submit" value="Save changes"/>
    </fieldset>
  </form>
</xsl:template>

<!-- Based on http://stackoverflow.com/a/1162495/894, modified -->
<!--
 ! Copy contents as is, escaping html tags
 !
 ! Use tags only to avoid whitespace
 -->
<xsl:template match="*" mode="copy-escaped">
  <xsl:text>&lt;</xsl:text>
    <xsl:value-of select="name()" />
    <xsl:for-each select="@*">
      <xsl:text> </xsl:text>
      <xsl:value-of select="name()" />
      <xsl:text>="</xsl:text>
      <xsl:call-template name="escape-text">
        <xsl:with-param name="text" select="." />
      </xsl:call-template>
      <xsl:text>"</xsl:text>
    </xsl:for-each>
  <xsl:text>&gt;</xsl:text>

  <xsl:apply-templates select="node()" mode="copy-escaped" />

  <xsl:text>&lt;/</xsl:text>
    <xsl:value-of select="name()" />
  <xsl:text>&gt;</xsl:text>
</xsl:template>
<xsl:template match="text()" mode="copy-escaped">
  <xsl:call-template name="escape-text">
    <xsl:with-param name="text" select="." />
  </xsl:call-template>
</xsl:template>

<!--
 ! Escape string
 ! Supported characters: &, <, >, ", '
 -->
<xsl:template name="escape-text">
  <xsl:param name="text" />
  <xsl:if test="$text != ''">
    <xsl:variable name="head" select="substring($text, 1, 1)"/>
    <xsl:variable name="tail" select="substring($text, 2)"/>
    <xsl:choose>
      <xsl:when test="$head = '&amp;'">&amp;amp;</xsl:when>
      <xsl:when test="$head = '&lt;'">&amp;lt;</xsl:when>
      <xsl:when test="$head = '&gt;'">&amp;gt;</xsl:when>
      <xsl:when test="$head = '&quot;'">&amp;quot;</xsl:when>
      <xsl:when test="$head = &quot;&apos;&quot;">&amp;apos;</xsl:when>
      <xsl:otherwise><xsl:value-of select="$head"/></xsl:otherwise>
    </xsl:choose>
    <xsl:call-template name="escape-text">
      <xsl:with-param name="text" select="$tail"/>
    </xsl:call-template>
  </xsl:if>
</xsl:template>

<!--
 ! Archive - list all months/years with published content, links for filtering
 -->
<xsl:template name="archive">
  <xsl:variable name="dates_">
    <xsl:if test="$showprivate">
      <xsl:apply-templates select="//post/date" mode="parse" />
    </xsl:if>
    <xsl:if test="not($showprivate)">
      <xsl:apply-templates select="//post[@private = 'no']/date" mode="parse" />
    </xsl:if>
  </xsl:variable>

  <xsl:variable name="dates" select="exsl:node-set($dates_)" />
  <!--<xsl:copy-of select="$dates"/>-->
  <div class="post">
    <h2>Archive</h2>
    <p>You can filter by year, month or day</p>
    <ul>
    <xsl:for-each select="$dates/date[not(following::date/year = ./year)]">
      <xsl:sort select="./year" order="descending" />
      <li>
        <a href="?year={./year}"><xsl:value-of select="./year" /></a>
        (<xsl:value-of select="count($dates/date[current()/year = ./year])"/>)
        <ul>
          <xsl:for-each select="$dates/date[./year = current()/year and not(following::date/month = ./month)]">
            <xsl:sort select="./month" order="descending" />
            <li>
              <a href="?year={./year}&amp;month={./month}"><xsl:value-of select="./month" /></a>
              (<xsl:value-of select="count($dates/date[current()/year = ./year and current()/month = ./month])"/>)
              <ul>
                <xsl:for-each select="$dates/date[./year = current()/year and ./month = current()/month and not(following::date/day = ./day)]">
                  <xsl:sort select="./day" order="descending" />
                  <li>
                    <a href="?year={./year}&amp;month={./month}&amp;day={./day}"><xsl:value-of select="./day" /></a>
                    (<xsl:value-of select="count($dates/date[current()/year = ./year and current()/month = ./month and current()/day = ./day])"/>)
                  </li>
                </xsl:for-each>
              </ul>
            </li>
          </xsl:for-each>
        </ul>
      </li>
    </xsl:for-each>
    </ul>
  </div>
</xsl:template>

<!--
 ! Parse date string and split it to a better format
 -->
<xsl:template match="date" mode="parse">
  <date>
    <year><xsl:value-of select="substring(., 1, 4)" /></year>
    <month><xsl:value-of select="substring(., 6, 2)" /></month>
    <day><xsl:value-of select="substring(., 9, 2)" /></day>
  </date>
</xsl:template>

<!--
 ! Parse date string and split it to a better format
 -->
<xsl:template match="date | lastUpdate" mode="pretty">
  <!--<xsl:value-of select="date:day-name(.)" />, <xsl:value-of select="date:day-in-month(.)" />. <xsl:value-of select="date:month-name(.)" />&#xA0;<xsl:value-of select="date:year(.)" />-->
  <!--at <xsl:value-of select="date:hour-in-day(.)" />:<xsl:value-of select="date:minute-in-hour(.)" />:<xsl:value-of select="date:second-in-minute(.)" />-->
  <xsl:value-of select="substring(., 9, 2)" />.<xsl:value-of select="substring(., 6, 2)" />.<xsl:value-of select="substring(., 1, 4)" /> at <xsl:value-of select="substring(., 12, 8)" />
</xsl:template>

<!--
 ! Tag link
 -->
<xsl:template match="tag">
  <a href="/?tag={.}" class="tag"><xsl:value-of select="."/></a>
</xsl:template>

<!--
 ! Display nickname with blog link and full name
 -->
<xsl:template match="nick">
  <a href="http://{.}.blog.matfyz.sk"><xsl:value-of select="."/></a>
  (<xsl:value-of select="../realName" />)
</xsl:template>

</xsl:stylesheet>
