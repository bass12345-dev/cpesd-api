<!DOCTYPE html>
 <html>
 <head>
   @include('includes.meta')
  @include('includes.css')



  <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }


      /* GLOBAL STYLES
-------------------------------------------------- */
/* Padding below the footer and lighter body text */

body {
  padding-top: 1rem;
/*  padding-bottom: 3rem;*/
  color: #5a5a5a;
}


/* CUSTOMIZE THE CAROUSEL
-------------------------------------------------- */

/* Carousel base class */
.carousel {
  margin-bottom: 4rem;
  margin-left: 4em;
  margin-right: 4em;

}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
  bottom: 3rem;
  z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel-item {
  height: 32rem;
}
.carousel-item > img {
  position: absolute;
  top: 0;
  left: 0;
  min-width: 100%;
  height: 32rem;
}




/* RESPONSIVE CSS
-------------------------------------------------- */

@media (min-width: 40em) {
  /* Bump up size of carousel content */
  .carousel-caption p {
    margin-bottom: 1.25rem;
    font-size: 1.25rem;
    line-height: 1.4;
  }

  .featurette-heading {
    font-size: 50px;
  }
}

@media (min-width: 62em) {
  .featurette-heading {
    margin-top: 7rem;
  }
}

h1,
h2,
h3,
h4,
h5,
h6 {
  margin: 8px 0;
}

p {
  margin: 0;
}

.spacer {
  flex: 1;
}
  .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;

    
  }

  .card {
    all: unset;
    border-radius: 4px;
    border: 1px solid #eee;
    background-color: #fafafa;
    height: 40px;
    width: 200px;
    margin: 0 8px 16px;
    padding: 16px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    transition: all 0.2s ease-in-out;
    line-height: 24px;
    border-radius: 15px;

  }

  .card-container .card:not(:last-child) {
    margin-right: 0;
  }

  .card.card-small {
    height: 16px;
    width: 168px;
  }

  .card-container .card:not(.highlight-card) {
    cursor: pointer;
  }

  .card-container .card:not(.highlight-card):hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 17px rgba(133, 8, 8, 0.363);

  }

  .card-container .card:not(.highlight-card):hover .material-icons path {
    fill: rgb(105, 103, 103);
  }

  
  .card span {
    margin-left: 8px;
  }

  .card span:hover {
    font-size: 20px;
  }

  
  .l-bg-cherry {
    background: linear-gradient(to left, #493240, #f09) !important;
    color: #fff;
}

.l-bg-blue-dark {
    background: linear-gradient(to right, #373b44, #4286f4) !important;
    color: #fff;
}

.l-bg-green-dark {
    background: linear-gradient(to right, #0a504a, #38ef7d) !important;
    color: #fff;
}

.l-bg-orange-dark {
    background: linear-gradient(to right, #a86008, #ffba56) !important;
    color: #fff;
}


@media screen and (max-width:768px) {
  .card {
    all: unset;
    border-radius: 4px;
    border: 1px solid #eee;
    background-color: #fafafa;
    height: 35px;
    width: 180px;
    margin: 0 3px 10px;
    padding: 12px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    transition: all 0.2s ease-in-out;
    line-height: 20px;
    border-radius: 15px;
  }

  .card-container {
    margin-top: 25px;
  }
}

@media screen and (min-width: 320x) {

  .card-container {
    margin-top: 25px;
  }

  .card {
    all: unset;
    border-radius: 4px;
    border: 1px solid #eee;
    background-color: #fafafa;
    height: 35px;
    width: 180px;
    margin: 0 8px 16px;
    padding: 12px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    transition: all 0.2s ease-in-out;
    line-height: 24px;
    border-radius: 15px;
  }
}


::ng-deep .custom-style-danger {
  --mdc-snackbar-container-color: #d9534f;
  --mdc-snackbar-supporting-text-color: white;
}



  </style>

 </head>
 <body>




<main>

    <div class="card-container" >
      <a class="card l-bg-orange-dark" href="http://cpesd-infosys.wuaze.com/login" >
        <i class="fas fa-file"></i>
        <span>PMAS/RFA</span>
        <svg class="material-icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>    </a>
        <!-- data-bs-toggle="modal" data-bs-target="#exampleModal"  -->
      <!-- a class="card l-bg-cherry" (click)="open_()">
        <mat-icon>remove_red_eye</mat-icon>
        <span class="mr-2">Watchlisted</span>
        <svg  class="material-icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
      </a> -->
      <a class="card l-bg-blue-dark" href="{{url('/dts')}}">
        <i class="fas fa-search"></i>
        <span>Document Tracker</span>
        <svg class="material-icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
      </a>
    <!--   <a class="card l-bg-blue-dark" (click)="open_labor()">
       
        <span>Labor Localization</span>
        <span style="font-size: 40px;">|</span>
        <span>WHIP Monitoring</span>
        <svg class="material-icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/></svg>
      </a> -->
</div>

  <div id="myCarousel"  class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/img/carousel2.jpg') }}" >
      </div>
      <div class="carousel-item">
          <img src="{{ asset('assets/img/carousel.jpg') }}"  >
      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/img/peso_logo.png')}}"  >
      </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>




    
</main>


 @include('includes.js')
 </body>
 </html>