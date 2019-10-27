class CaptchaResponsive {
    constructor() {
        this.width = $('.g-recaptcha').parent().width();

        this.scale;
        this.rescaleCaptcha();
    }

    rescaleCaptcha() {

        if (this.width < 302) {
      this.scale = this.width / 302;
    } else{
      this.scale = 1.0; 
    }

    $('.g-recaptcha').css('transform', 'scale(' + this.scale + ')');
    $('.g-recaptcha').css('-webkit-transform', 'scale(' + this.scale + ')');
    $('.g-recaptcha').css('transform-origin', '0 0');
    $('.g-recaptcha').css('-webkit-transform-origin', '0 0');
  }
    
    
    resizeCaptcha(){
        $( window ).resize(function() { this.rescaleCaptcha(); });
    }
    }