<?php
/*
  Template Name: Home Template
 */
?>

<?php get_header(); ?>

<div id="content">

    <div id="inner-content" class="row">

        <?php if (is_front_page()): ?>

            <main id="main" class="large-6 medium-6 columns" role="main">

            <?php else: ?>

                <main id="main" class="large-8 medium-8 columns" role="main">

                <?php endif; ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                        <!-- To see additional archive styles, visit the /parts directory -->
                        <?php get_template_part('parts/loop', 'archive'); ?>

                    <?php endwhile; ?>	

                    <?php joints_page_navi(); ?>

                <?php else : ?>

                    <?php get_template_part('parts/content', 'missing'); ?>

                <?php endif; ?>


                <!-- Temp style -->
                <iframe width="560" height="315" src="https://www.youtube.com/embed/lIdJZXknVM0" frameborder="0" allowfullscreen></iframe>

                <h2>On todays show</h2>

                <ul>

                    <li> -------- </li>
                    <li> -------- </li>
                    <li> -------- </li>
                    <li> -------- </li>

                </ul>


            </main> <!-- end #main -->

            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("homepagesidebar")) : ?>

                <?php dynamic_sidebar('homepagesidebar'); ?>

            <?php endif; ?>

    </div> <!-- end #inner-content -->

</div> <!-- end #content -->

<hr />

<section class="row" id="second-band">
    <div class="band__inner wrapper">      
        <div class="text-center">
            <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("homepagebelowmaincontent")) : ?>

                <?php dynamic_sidebar('homepagebelowmaincontent'); ?>

            <?php endif; ?>
        </div>


        <article class="learning__item box3--getting-started mobile-half tablet-and-up-half desktop-quarter large-3 columns">
            <a href="/en-gb/getting-started/">
                <picture class="responsiveImg learning__item__img">
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <source media="(min-width: 1024px)" srcset="/global/img/homepage/learning/box3/01-large.jpg"></source>
                    <source media="(min-width: 768px)" srcset="/global/img/homepage/learning/box3/02-medium.jpg"></source>
                    <source media="(max-width: 767px)" srcset="/global/img/homepage/learning/box3/03-small.jpg"></source>
                    <!--[if IE 9]></video><![endif]-->
                    <img alt="Workshops" class="learning__item__img">
                    <meta content="/global/img/homepage/learning/box3/01-large.jpg" itemprop="image">
                </picture>
                <div class="inner-border">
                    <div class="inner-border__txt"> 
                        <h2>Getting Started</h2>
                        <p>Learn the basics of jewellery making</p>
                        <div class="rule"></div>
                        <div class="inner-border--dummylink"><span>Find Out</span> More &gt;</div>
                    </div> 
                </div>
            </a>
        </article>
        <article class="learning__item box2--workshops mobile-half tablet-and-up-half large-3 columns">
            <a href="/en-gb/learning/workshops/">
                <picture class="responsiveImg learning__item__img">
                    <!--[if IE 9]><video style="display: none;"><![endif]-->
                    <source media="(min-width: 1024px)" srcset="/global/img/homepage/learning/box2/01-large.jpg"></source>
                    <source media="(min-width: 768px)" srcset="/global/img/homepage/learning/box2/02-medium.jpg"></source>
                    <source media="(max-width: 767px)" srcset="/global/img/homepage/learning/box2/03-small.jpg"></source>
                    <!--[if IE 9]></video><![endif]-->
                    <img alt="Workshops" class="learning__item__img">
                    <meta content="/global/img/homepage/learning/box2/01-large.jpg" itemprop="image">
                </picture>
                <div class="inner-border">
                    <div class="inner-border__txt"> 
                        <h2>Workshops</h2>
                        <p>Learn a new skill here at the JM studios</p>
                        <div class="rule"></div>
                        <div class="inner-border--dummylink"><span>Find Out</span> More &gt;</div>
                    </div> 
                </div>
            </a>          
        </article>

        <article class="learning__item box1--videos mobile-full tablet-and-up-half large-6 columns">
            <a href="/en-gb/learning/video-tutorials/">  
                <div class="promotional-box accent-color">
                    <picture class="responsiveImg learning__item__img promotional-box--bg">
                        <!--[if IE 9]><video style="display: none;"><![endif]-->
                        <source media="(min-width: 1024px)" srcset="/global/img/homepage/learning/box1/01-large.jpg"></source>
                        <source media="(min-width: 768px)" srcset="/global/img/homepage/learning/box1/02-medium.jpg"></source>
                        <source media="(max-width: 767px)" srcset="/global/img/homepage/learning/box1/03-small.jpg"></source>
                        <!--[if IE 9]></video><![endif]-->
                        <img alt="Featured Product Video" class="learning__item__img">
                        <meta content="/global/img/homepage/learning/box1/01-large.jpg" itemprop="image">
                    </picture>
                    <div class="inner-border">
                        <div class="inner-border__txt"> 
                            <h2>Video Tutorials</h2>
                            <p>Whatever your level of experience is, learn from our wide range of free video tutorials</p>
                            <div class="rule"></div>
                            <div class="inner-border--dummylink"><span>Find Out</span> More &gt;</div>
                        </div> 
                    </div>

                </div>
            </a>
        </article>

        <article class="learning__item box4 mobile-full tablet-and-up-half  large-6 columns">

            <div class="learning__item__subtitle">
                <hr class="rule">
                <h2>Hints &amp; Tips</h2>
            </div>
            <a href="/en-gb/how-to/create-multifunctional-pearl-jewellery.aspx">
                <div class="promotional-box">
                    <picture class="responsiveImg learning__item__img">
                        <!--[if IE 9]><video style="display: none;"><![endif]-->
                        <source media="(min-width: 1024px)" srcset="http://www.jewellerymaker.com/en-gb/global/img/homepage/learning/tip/multifunctional-pearls.jpg"></source>
                        <source media="(min-width: 768px)" srcset="http://www.jewellerymaker.com/en-gb/global/img/homepage/learning/tip/multifunctional-pearls477.jpg"></source>
                        <source media="(max-width: 767px)" srcset="http://www.jewellerymaker.com/en-gb/global/img/homepage/learning/tip/multifunctional-pearls717.jpg"></source>
                        <!--[if IE 9]></video><![endif]-->
                        <img alt="Hints and Tips" class="promotional-box--bg">
                        <meta content="/global/img/homepage/learning/tip/multifunctional-pearls.jpg" itemprop="image">
                    </picture>

                    <div class="promotional-box__rounded-layer"></div>
                    <div class="promotional-box__txt">
                        <div class="promotional-box__txt--preheader">How to Create a</div>
                        <div class="promotional-box__txt--header">Multi-functional Pearl Set</div>
                        <div class="rule"></div>
                        <div class="promotional-box__txt--dummylink">Learn Now &gt;</div>
                    </div>
                </div>
            </a> 
        </article>
        <article class="learning__item recent-tutorials tablet-and-up-half desktop-only large-6 columns">

            <div class="learning__item__subtitle">
                <hr class="rule">
                <h2>Recent Tutorials</h2>
                <a href="/en-gb/learning/video-tutorials/?video=how-to-use-earring-wire-looper">
                    <div class="desktop-quarter recent-tutorials__item recent-tutorial__one large-6 columns">
                        <img alt="" class="learning__item__img" src="//cdn.jewellerymaker.com/global/img/homepage/learning/vid-tut1.jpg">
                        <div class="recent-tutorials__item__txt">How to Use an Earring Wire Looper</div>
                        <div class="rule"></div>
                    </div>
                </a>
                <a href="/en-gb/learning/video-tutorials/?video=how-to-use-wags-wicone-maxi">
                    <div class="desktop-quarter recent-tutorials__item recent-tutorial__two  large-6 columns">
                        <img alt="" class="learning__item__img" src="//cdn.jewellerymaker.com/global/img/homepage/learning/vid-tut2.jpg">
                        <div class="recent-tutorials__item__txt">How to Use a Wags Wicone Maxi</div>
                        <div class="rule"></div>
                    </div>

                </a>
            </div>           
            <div class=""></div>

        </article>

    </div>
    <div class="clear"></div>
</section>        

<?php get_footer(); ?>