<!DOCTYPE html>
<html>
<head>
    <title>Book Review</title>
    <!-- Other meta tags and stylesheets -->
    <style>
        /* Add custom styles here */
        /* Your existing styles */
        /* ... */
        .star {
            font-size: 24px;
            cursor: pointer;
            color: red;
        }
    </style>
    <script>
        let selectedRating = 0; // Default value

        function updateRating(rating) {
            selectedRating = rating;
            updateStarColors();
        }

        function updateStarColors() {
            const stars = document.getElementsByClassName("star");
            for (let i = 0; i < stars.length; i++) {
                if (i < selectedRating) {
                    stars[i].innerHTML = '★'; // Filled star
                } else {
                    stars[i].innerHTML = '☆'; // Empty star
                }
            }

            document.getElementById("selectedRating").value = selectedRating;
        }

        // Initialize star colors based on default rating
        updateStarColors();
    </script>
</head>
<body>
    <!-- Your existing HTML content -->

    <div class="feedback-form">
        <h1>How was your Experience</h1>
        <!-- Your existing form -->
        <form action="" method="post">
            <!-- ... Other form fields -->
            <div>
                <span>Rating: </span>
                <span>
                    <span class="star" onclick="updateRating(1)">☆</span>
                    <span class="star" onclick="updateRating(2)">☆</span>
                    <span class="star" onclick="updateRating(3)">☆</span>
                    <span class="star" onclick="updateRating(4)">☆</span>
                    <span class="star" onclick="updateRating(5)">☆</span>
                </span>
            </div>
            <input type="hidden" id="selectedRating" name="ratingValue" value="">
            <input type="submit" value="Submit">
        </form>
    </div>

    <!-- Your remaining HTML content -->
</body>
</html>
