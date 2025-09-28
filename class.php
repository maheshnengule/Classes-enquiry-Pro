<?php
// DB connection
$conn = new mysqli("your-rds-endpoint","db_user","db_pass","mahesh_quiz");
if ($conn->connect_error) { die("DB Connection failed: " . $conn->connect_error); }

$name=$email=$course="";
$success=false;

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name   = $conn->real_escape_string($_POST['name']);
    $email  = $conn->real_escape_string($_POST['email']);
    $course = $conn->real_escape_string($_POST['course']);
    if ($name!="" && $email!="" && $course!="") {
        $conn->query("INSERT INTO class_enquiries (name,email,course) VALUES('$name','$email','$course')");
        $success=true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mahesh Classes</title>
<style>
body {
  margin:0; font-family: 'Segoe UI',sans-serif;
  background: linear-gradient(45deg,#6a11cb,#2575fc); color:#fff;
  display:flex; align-items:center; justify-content:center; min-height:100vh;
}
header h1 {
  font-size:48px; margin:0; text-shadow:2px 2px #000;
}
.courses {
  display:grid; grid-template-columns:repeat(auto-fit,minmax(250px,1fr)); gap:20px; padding:20px;
}
.card {
  background:rgba(255,255,255,0.1); border-radius:15px; padding:20px; backdrop-filter:blur(5px); 
  box-shadow:0 8px 16px rgba(0,0,0,0.2); transition: transform .3s;
}
.card:hover { transform:translateY(-8px) scale(1.05);}
form {
  background:rgba(255,255,255,0.1); margin:20px auto; padding:30px; max-width:500px; border-radius:15px;
  box-shadow:0 8px 16px rgba(0,0,0,0.2);
}
input,select,button {
  width:100%; padding:10px; margin:10px 0; border:none; border-radius:8px; font-size:16px;
}
input,select {
  background:#fff; color:#000;
}
button {
  background:#ffeb3b; color:#000; font-weight:bold; cursor:pointer; transition:background .3s;
}
button:hover { background:#fff176; }
.thankyou {
  text-align:center; animation:fadeIn 1s;
}
.thankyou h2 {
  font-size:40px; margin-bottom:10px;
}
.thankyou p {
  font-size:20px;
}
@keyframes fadeIn {from{opacity:0; transform:scale(0.9);} to{opacity:1; transform:scale(1);}}
</style>
</head>
<body>

<?php if($success): ?>
  <div class="thankyou">
    <h2>🎉 Thank You, <?php echo htmlspecialchars($name); ?>!</h2>
    <p>We’ve received your enquiry for <strong><?php echo htmlspecialchars($course); ?></strong>.</p>
    <p>Our team will contact you soon at <strong><?php echo htmlspecialchars($email); ?></strong>.</p>
  </div>
<?php else: ?>
  <div>
    <header>
      <h1>🌟 Welcome to Mahesh Classes 🌟</h1>
      <p>Build your future with our expert courses</p>
    </header>
    <section class="courses">
      <div class="card"><h3>MCA (Master in Cloud Architecture)</h3><p>₹40,000</p></div>
      <div class="card"><h3>Java Full Stack</h3><p>₹35,000</p></div>
      <div class="card"><h3>MERN Stack</h3><p>₹30,000</p></div>
      <div class="card"><h3>Data Analytics</h3><p>₹30,000</p></div>
      <div class="card"><h3>Data Science</h3><p>₹30,000</p></div>
    </section>
    <form method="post">
      <h2 style="text-align:center;">Enquiry Form</h2>
      <input type="text" name="name" placeholder="Enter your Name" required>
      <input type="email" name="email" placeholder="Enter your Email" required>
      <select name="course" required>
        <option value="">Select Course</option>
        <option value="MCA">MCA (Master in Cloud Architecture)</option>
        <option value="Java Full Stack">Java Full Stack</option>
        <option value="MERN Stack">MERN Stack</option>
        <option value="Data Analytics">Data Analytics</option>
        <option value="Data Science">Data Science</option>
      </select>
      <button type="submit">Submit</button>
    </form>
  </div>
<?php endif; ?>

</body>
</html>
