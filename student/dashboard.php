
<div class="dashboard">

    <h2>Student Dashboard</h2>

    <div class="grid">

        <a href="menu.php" class="box">
            <div class="icon">🍽️</div>
            <h3>View Menu</h3>
            <p>View food items, price, quantity and place your order.</p>
        </a>

        <a href="my_orders.php" class="box">
            <div class="icon">🛒</div>
            <h3>My Orders</h3>
        View current order, token,
        bill and order history.
        </a>

        <a href="profile.php" class="box">
            <div class="icon">👤</div>
            <h3>My Profile</h3>
            <p>View and update your personal information.</p>
        </a>

        </a>

        <a href="../logout.php" class="box logout">
    <div class="icon">🚪</div>
    <h3>Logout</h3>
    <p>Sign out from your account.</p>
</a>

    </div>

</div>
</div>


<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

body{
    background:linear-gradient(135deg,#e3f2fd,#e0f7fa);
    min-height:100vh;
}

.dashboard{
    width:90%;
    max-width:1000px;
    margin:40px auto;
    background:#ffffff;
    padding:35px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.15);
}

.dashboard h2{
    text-align:center;
    color:#0d6efd;
    margin-bottom:35px;
    font-size:30px;
}

.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:25px;
}

.box{
    height:190px;
    border-radius:16px;
    text-decoration:none;
    color:#2c3e50;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    padding:20px;
    transition:.3s;
    box-shadow:0 8px 20px rgba(0,0,0,.08);
}

/* Different colors for each card */

.box:nth-child(1){
    background:#E3F2FD;
}

.box:nth-child(2){
    background:#E8F5E9;
}

.box:nth-child(3){
    background:#FFF3E0;
}

.box:nth-child(4){
    background:#F3E5F5;
}

.box:nth-child(5){
    background:#FFFDE7;
}

.box:nth-child(6){
    background:#FDECEC;
}

.box:hover{
    transform:translateY(-8px);
    background:#0d6efd;
    color:#fff;
    box-shadow:0 15px 30px rgba(13,110,253,.30);
}

.box:hover h3,
.box:hover p{
    color:#fff;
}

.icon{
    font-size:55px;
    margin-bottom:15px;
}

.box h3{
    color:#0d6efd;
    font-size:22px;
    margin-bottom:10px;
}

.box p{
    color:#555;
    font-size:15px;
    line-height:1.5;
}

/* Logout */

.logout{
    background:#dbeafe !important;
    color:#0d6efd !important;
}

.logout:hover{
    background:#0d6efd !important;
    color:#fff !important;
}