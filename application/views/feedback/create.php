<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback Form</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="feedback-container">
      <h1><i class="fas fa-comments"></i>Share your Feedback</h1>
      <p>We'd love to hear your thoughts and improve based on your suggestions!.</p>
      <form action="<?=base_url('feedback/create'); ?>" method="POST" class="feedback-form">
        <div class="form-group">
          <label for="name"><i class="fas fa-user"></i>Name</label>
          <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
        </div>
        <div class="form-group">
          <label for="email"><i class="fas fa-envelope"></i>Email</label>
          <input type="email" name="email" id="email" placeholder="Enter Your Email" required>
        </div>
         <div class="form-group">
          <label for="rating"><i class="fas fa-star"></i>Rating</label>
          <select name="rating" id="rating" required>
            <option value="" disabled selected>Select a rating</option>
            <option value="5">Excellent</option>
            <option value="4">Good</option>
            <option value="3">Average</option>
            <option value="2">Poor</option>
            <option value="1">Terrible</option>
           
          </select>
         </div>
         <div class="form-group">
          <label for="comments"><i class="fas fa-comment"></i>Comments</label>
          <textarea name="comments" id="comments" placeholder="Write your message...." rows="5" required></textarea>

         </div>
         <button type="submit" class="btn"><i class="fas fa-paper-plane"></i>Submit Feedback</button>
      </form>
    </div>
</body>
</html>
<style>
	* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body{
  font-family: 'poppins',sans-serif;
  background: #007bff;
  color: #fff;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  padding: 20px;
}
.feedback-container{
  background: #fff;
  color: #333;
  padding: 30px 20px;
  border-radius: 12px;
  max-width: 400px;
  width: 90%;
  box-shadow: 0px 10px 30px rgba(0,0,0,0.2);
  animation: fadeIn 1s ease-in-out;

}
.feedback-container h1{
  font-size: 26px;
  margin-bottom: 10px;
  color: #007bff;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
}
.feedback-container p{
  font-size: 14px;
  margin-bottom: 20px;
  color: #555;
}
.feedback-form{
  display: flex;
  flex-direction: column;
  gap: 15px;
}
.form-group label{
  font-size: 14px;
  margin-bottom: 5px;
  display: flex;
  align-items: center;
  gap: 5px;
  color:  #007bff;
}
.form-group input,
.form-group select,
.form-group textarea{
  width: 100%;
  padding: 10px 15px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 8px;
  outline: none;
  transition: border-color 0.3s ease;
}
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
  border-color: #8F94FB;
  box-shadow: 0px 4px 8px rgba(78,84,200,0.2);
}
.btn{
  padding: 12px 20px;
  font-size: 16px;
  font-weight: bold;
  background:  #007bff;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.btn:hover{
  transform: scale(1.05);
}
@keyframes fadeIn{
  from{
    opacity: 0;
    transform: translateY(10px);
  }
  to{
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
