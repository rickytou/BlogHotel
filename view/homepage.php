<?php declare(strict_types=1);
require_once('./includes/head.php');
?>
<main id="main">
  <div class="main">
    <!-- Header -->
   <div class="video">
    <video autoplay="autoplay" muted="" loop="infinite" src="./public/videos/video.mp4"></video>
    <div class="mainheader">
    <form action="#" class="form-search">
      <div class="input-control">
        <input type="search" name="" id="" placeholder="Trouver un h&ocirc;tel...">
        <p>
          <span class="fa-solid fa-magnifying-glass"></span>
        </p>
      </div>

    </form>
    <h1>
      D&eacute;couvrez les meilleurs
      <span>H&ocirc;tels du Qu&eacute;bec</span>
    </h1>
    <p class="text-accroche">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi commodi ea quod incidunt, voluptas tenetur reprehenderit sequi dicta at officiis?
      <a href="#blog" class="fa-solid fa-chevron-down"></a>
    </p>

    </div>
   </div>
   <!-- Fin Header -->
   <!-- Nos recentes publications -->
   <div class="recent-posts" id="blog">
    <h2>Nos r&eacute;centes publications</h2>
    <!-- Entete Posts Bloc --> 
    <div class="recent-posts-group">
    <!-- Bloc1 .-->
    <article class="recent-posts-bloc">
      <!-- Entete Posts Bloc Entete --> 
      <div class="recent-posts-image">
        <img src="https://images.pexels.com/photos/518244/pexels-photo-518244.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      </div>
      <!-- Entete Posts Main -->
      <div class="recent-posts-main">
        <div class="recent-posts-title">
          <strong>Hotel Berkshire</strong>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto libero sunt et, quod laborum voluptatibus quidem quo, dolorem accusamus sint, repellat rerum rem. Dolorem libero optio cupiditate earum similique.</p>
      </div> 
    </article>
    <!-- Fin Bloc1 -->
    <!-- Bloc2 .-->
    <article class="recent-posts-bloc">
      <!-- Entete Posts Bloc Entete --> 
      <div class="recent-posts-image">
        <img src="https://images.pexels.com/photos/1755288/pexels-photo-1755288.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      </div>
      <!-- Entete Posts Main -->
      <div class="recent-posts-main">
        <div class="recent-posts-title">
          <strong>Hotel Berkshire</strong>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto libero sunt et, quod laborum voluptatibus quidem quo, dolorem accusamus sint, repellat rerum rem. Dolorem libero optio cupiditate earum similique.</p>
      </div> 
    </article>
    <!-- Fin Bloc2 -->
    <!-- Bloc3 .-->
    <article class="recent-posts-bloc">
      <!-- Entete Posts Bloc Entete --> 
      <div class="recent-posts-image">
        <img src="https://images.pexels.com/photos/756083/pexels-photo-756083.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      </div>
      <!-- Entete Posts Main -->
      <div class="recent-posts-main">
        <div class="recent-posts-title">
          <strong>Hotel Berkshire</strong>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto libero sunt et, quod laborum voluptatibus quidem quo, dolorem accusamus sint, repellat rerum rem. Dolorem libero optio cupiditate earum similique.</p>
      </div> 
    </article>
    <!-- Fin Bloc3 -->
    <!-- Bloc4 .-->
    <article class="recent-posts-bloc">
      <!-- Entete Posts Bloc Entete --> 
      <div class="recent-posts-image">
        <img src="https://images.pexels.com/photos/271639/pexels-photo-271639.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="">
      </div>
      <!-- Entete Posts Main -->
      <div class="recent-posts-main">
        <div class="recent-posts-title">
          <strong>Hotel Berkshire</strong>
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt architecto libero sunt et, quod laborum voluptatibus quidem quo, dolorem accusamus sint, repellat rerum rem. Dolorem libero optio cupiditate earum similique.</p>
      </div> 
    </article>
    <!-- Fin Bloc4 -->
    </div>
   </div>
   <!-- Fin -->
   <!-- Temoignages -->
   <!-- Section Temoignages Wrapper -->
   <section id="temoignages">
      <div class="temoignages">
        <!-- Titre de la section -->
        <h2>
          Ce que disent <span>nos visiteurs ?</span>
        </h2>
        <!-- Temoignages [Zone de navigation] -->
        <div class="temoignages__navigation__bloc">
        <p class="temoignages__navigation temoignages__navigation__left">
            <i class="fa-solid fa-arrow-left"></i>
          </p>
          <p class="temoignages__navigation temoignages__navigation__right active">
            <i class="fa-solid fa-arrow-right"></i>
          </p>
          
        </div>
        <!-- Bloc de temoignages -->
        <div class="temoignages__bloc">
          <!-- Temoignages comments [Temoignages1] -->
          <div class="temoignages__bloc__group active">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>John Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages2] -->
          <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Johnny Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages3] -->
          <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Jane Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

          <!-- Temoignages comments [Temoignages4] -->
          <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Spence Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

           <!-- Temoignages comments [Temoignages5] -->
           <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Steeve Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

           <!-- Temoignages comments [Temoignages6] -->
           <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Bryan Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

           <!-- Temoignages comments [Temoignages7] -->
           <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Jack Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->

           <!-- Temoignages comments [Temoignages8] -->
           <div class="temoignages__bloc__group">
              <div class="temoignages__bloc__comments">
                <div class="temoignages__bloc__comments_user">
                  <blockquote>
                  <i class="fa-solid fa-quote-left"></i>
                    <p>Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries.
                    </p>
                    <i class="fa-solid fa-quote-right"></i>
                    <cite>
                      <span>Pitt Doe</span>
                    </cite>
                  </blockquote>
                </div>
              </div>
              <!-- Temoignages bloc design -->
              <div class="temoignages__bloc__design"></div>
              <!-- Temoignages profil de l'utilisateur -->
              <div class="temoignages__bloc__profil">
                  <img src="./public/images/avatar.png" alt="avatar"/>    
              </div>
            </div>
          <!-- Fin -->
  <!-- Fin Temoignages -->
  </div>
</section>
<section id="contact">
  <div class="contact">
    <h2>Comment nous trouver ?</h2>
    <div class="contact-social-media">
      <div class="contact-social-media-bloc">
      <span class="fa-solid fa-phone"></span>
        <p>
          <b>Telephone</b>
          <span>Appelez:+00-11-22-33-44</span>
        </p>
</div>
      <div class="contact-social-media-bloc">
      <span class="fa-regular fa-envelope"></span>
      <p>
        <b>Courriel</b>
        <span>bloghotel@gbloghotel.ca</span>
      </p>
</div>
      <div class="contact-social-media-bloc">
        <span class="fa-brands fa-facebook-f"></span>
        <p>
          <b>Facebook</b>
          <span>Page compagnie</span>
        </p>
</div>
    </div>

   <!-- <form action="" id="form-contact">
    <div class="contact-input-control">
      <input type="text" id="nom">
      <label for="nom">Nom</label>
    </div>
    <div class="contact-input-control">
      <input type="text" id="courriel">
      <label for="courriel">Courriel</label>
    </div>
    <div class="contact-input-control">
      <input type="text" id="sujet">
      <label for="sujet">Sujet</label>
    </div>
    <div class="contact-input-control">
      <textarea name="" id=""></textarea>
      <label for="sujet">Message</label>
    </div>
    <div class="contact-input-control">
      <input type="submit" value="Envoyer">
    </div>
   </form> -->
  </div>
</section>
</main>
<?php require_once('./includes/footer.php');