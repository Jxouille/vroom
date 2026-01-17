<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://cdn.boxicons.com/3.0.7/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin.css">
    <title>Admin</title>
</head>
<body>
    
    <!-- SIDEBAR -->
    <section id="sidebar" class="bar">
        <img src="images/vroom_logo_sansfond.png" alt="">
        <ul class="side-menu">
            <li><a href="#" class="active"><i class='bx  bxs-dashboard icon' ></i> tableau de bord </a></li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class='bxr  bx-community icon' ></i> Gestion utilisateurs <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="#">Alert</a></li>
                    <li><a href="#">Badges</a></li>
                    <li><a href="#">Breadcrumbs</a></li>
                    <li><a href="#">Button</a></li>
                </ul>
            </li>
            <li><a href="#"><i class='bx  bx-chart-sine icon' ></i> Graphiques </a></li>
            <li><a href="#"><i class='bx  bx-trip icon' ></i> Gestion trajets </a></li>
            <li class="divider" data-text="table and forms">Tableaux et formulaires</li>
            <li><a href="#"><i class='bx  bx-table icon' ></i> Tableaux </a></li>
            <li>
                <a href="#"><i class='bx  bx-form icon' ></i> Formulaires <i class='bx bx-chevron-right icon-right' ></i></a>
                <ul class="side-dropdown">
                    <li><a href="#">Basic</a></li>
                    <li><a href="#">Select</a></li>
                    <li><a href="#">Checkbox</a></li>
                    <li><a href="#">Radio</a></li>
                </ul>
            </li>
        </ul>
        <div class="ads">
            <div class="wrapper">
                <a href="#" class="btn-upgrade">Deconnexion</a>
                <p>Become a <span>PRO</span> member and enjoy <span>All Features</span></p>
            </div>
        </div>
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar' ></i>
            <form action="#">
                <div class="form-group">
                    <input type="text" placeholder="Search...">
                    <i class='bx bx-search icon' ></i>
                </div>
            </form>
            <a href="#" class="nav-link">
                <i class='bx bxs-bell icon' ></i>
                <span class="badge">5</span>
            </a>
            <a href="#" class="nav-link">
                <i class='bx bxs-message-square-dots icon' ></i>
                <span class="badge">8</span>
            </a>
            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                <ul class="profile-link">
                    <li><a href="#"><i class='bx bxs-user-circle icon' ></i> Profile</a></li>
                    <li><a href="#"><i class='bx bxs-cog' ></i> Settings</a></li>
                    <li><a href="#"><i class='bx bxs-log-out-circle' ></i> Logout</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1 class="title">Tableau de bord</h1>
            <ul class="breadcrumbs">
                <li><a href="#">Home</a></li>
                <li class="divider">/</li>
                <li><a href="#" class="active">Dashboard</a></li>
            </ul>
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>1237</h2>
                            <p>Trafiques</p>
                        </div>
                        <i class='bx bx-trending-up icon' ></i>
                    </div>
                    <span class="progress" data-value="40%"></span>
                    <span class="label">40%</span>
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>234</h2>
                            <p>Trajets publiés</p>
                        </div>
                        <i class='bx bx-trending-down icon down' ></i>
                    </div>
                    <span class="progress" data-value="60%"></span>
                    <span class="label">60%</span>
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>465</h2>
                            <p>Vues</p>
                        </div>
                        <i class='bx bx-trending-up icon' ></i>
                    </div>
                    <span class="progress" data-value="30%"></span>
                    <span class="label">30%</span>
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>235</h2>
                            <p>Visiteurs</p>
                        </div>
                        <i class='bx bx-trending-up icon' ></i>
                    </div>
                    <span class="progress" data-value="80%"></span>
                    <span class="label">80%</span>
                </div>
            </div>
            
            <!-- DATA -->

            <div class="data">
                <div class="content-data">
                    <div class="head">
                        <h3>Trajets journaliers</h3>
                        <div class="menu">
                            <i class='bx bx-dots-horizontal-rounded icon'></i>
                            <ul class="menu-link">
                                <li><a href="#">Modifier</a></li>
                                <li><a href="#">Sauvegarder</a></li>
                                <li><a href="#">Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart">
                        <div id="chart"></div>
                    </div>
                </div>

                <div class="content-data">
                    <div class="head">
                        <h3>Trajets mensuels </h3>
                        <div class="menu">
                            <i class='bx bx-dots-horizontal-rounded icon'></i>
                            <ul class="menu-link">
                                <li><a href="#">Modifier</a></li>
                                <li><a href="#">Sauvegarder</a></li>
                                <li><a href="#">Supprimer</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chart">
                        <div id="chart"></div>
                    </div>
                </div>


                <!--div class="content-data">
                    <div class="head">
                        <h3>Trajets </h3>
                        <div class="menu">
                            <i class='bx bx-dots-horizontal-rounded icon'></i>
                            <ul class="menu-link">
                                <li><a href="#">Edit</a></li>
                                <li><a href="#">Save</a></li>
                                <li><a href="#">Remove</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-box">
                        <p class="day"><span>Today</span></p>
                        <div class="msg">
                            <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                            <div class="chat">
                                <div class="profile">
                                    <span class="username">Alan</span>
                                    <span class="time">18:30</span>
                                </div>
                                <p>Hello</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptatum eos quam dolores eligendi exercitationem animi nobis reprehenderit laborum! Nulla.</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, architecto!</p>
                            </div>
                        </div>
                        <div class="msg me">
                            <div class="chat">
                                <div class="profile">
                                    <span class="time">18:30</span>
                                </div>
                                <p>Lorem ipsum, dolor sit amet.</p>
                            </div>
                        </div>
                    </div>
                    <form action="#">
                        <div class="form-group">
                            <input type="text" placeholder="Type...">
                            <button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
                        </div>
                    </form>
                </div-->
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="script.js"></script>
</body>
</html>

<!-- Vue/pages/v_admin.php -->

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <div class="container">
        <div class="tabs">
            <div class="tab active" onclick="switchTab('utilisateurs')">Utilisateurs</div>
            <div class="tab" onclick="switchTab('trajets')">Trajets</div>
        </div>

        <div id="utilisateurs" class="content-section active">
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Inscrit le</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($utilisateurs)): ?>
                        <?php foreach ($utilisateurs as $u): ?>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://i.pravatar.cc/150?u='.$u['id'] ?>" alt="avatar" class="avatar">
                                        <span>
                                            <?= htmlspecialchars($u["nom"] ?? '') ?> 
                                            <?= htmlspecialchars($u["prenom"] ?? '') ?>
                                        </span>
                                    </div>
                                </td>
                                <td>#<?= htmlspecialchars($u["id"] ?? '') ?></td>
                                <td><?= htmlspecialchars($u["email"] ?? '') ?></td>
                                <td><?= date('d/m/Y', strtotime($u["date_creation"])) ?></td>
                                <td><span class="status-badge">Actif</span></td>
                                <td class="actions">
                                    <a href="profil.php?id=<?= $u['id'] ?>"><i class="fa-regular fa-eye"></i></a>
                                    <i class="fa-regular fa-circle-xmark"></i>
                                    <i class="fa-regular fa-trash-can"></i>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align:center; padding: 20px;">Aucun utilisateur trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div id="trajets" class="content-section">
            <div class="empty-state">
                <i class="fa-solid fa-car-side fa-3x"></i>
                <p>La liste des trajets s'affichera ici via votre requête SQL.</p>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll('.content-section').forEach(section => section.classList.remove('active'));

            event.currentTarget.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        }
    </script>

</body>
