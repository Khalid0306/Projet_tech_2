<!DOCTYPE html>
<html>
<head>
    <title>Stylish Slider</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        .slider-container {
            width: 800px;
            height: 400px;
            margin: 50px auto;
            overflow: hidden;
            position: relative;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .slider-content {
            display: flex;
            width: 300%;
            height: 100%;
            transition: transform 0.5s ease-in-out;
            animation: slideAnimation 10s infinite;
        }

        .slide {
            width: 33.33%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .slide-content {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: #fff;
        }

        .slide-content h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .slide-content p {
            font-size: 16px;
        }

        .highlight-title {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 28px;
            color: #fff;
            font-weight: bold;
        }

        @keyframes slideAnimation {
            0% {
                transform: translateX(0);
            }
            33.33% {
                transform: translateX(-33.33%);
            }
            66.66% {
                transform: translateX(-66.66%);
            }
            100% {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="slider-container">
        
        <div class="slider-content">
            <div class="slide">
                <img src="img/Les Demoiselles d'Avignon.png" alt="Image 1">
                <div class="slide-content">
            
                </div>
            </div>
            <div class="slide">
                <img src="img/img2.jpg" alt="Image 2">
                <div class="slide-content">

                </div>
            </div>
            <div class="slide">
                <img src="img/La Guerre et la Paix.jpg" alt="Image 3">
                <div class="slide-content">
                </div>
            </div>
        </div>
    </div>

    <script>
        // Slider functionality
        const sliderContent = document.querySelector('.slider-content');
        const slideWidth = document.querySelector('.slide').offsetWidth;

        let slideIndex = 0;
        let autoSlideInterval;

        function updateSlidePosition() {
            sliderContent.style.transform = `translateX(-${slideIndex * slideWidth}px)`;
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            autoSlideInterval = setInterval(() => {
                slideIndex = (slideIndex + 1) % 3;
                updateSlidePosition();
            }, 5000);
        }

        // Start auto slide
        resetAutoSlide();
    </script>
</body>
</html>
