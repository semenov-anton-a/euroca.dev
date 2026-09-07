<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Accordion Test</title>

    <!-- Bootstrap 5 CSS -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h3 class="mb-4">
        ERP Modules
    </h3>


    <div class="accordion" id="accordionERP">


        <!-- AUTH -->
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingAuth">

                <button 
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseAuth"
                    aria-expanded="true"
                    aria-controls="collapseAuth">

                    🔐 Авторизация

                </button>

            </h2>


            <div 
                id="collapseAuth"
                class="accordion-collapse collapse show"
                aria-labelledby="headingAuth"
                data-bs-parent="#accordionERP">

                <div class="accordion-body">

                    <ul>
                        <li>User login</li>
                        <li>Password verification</li>
                        <li>Session management</li>
                        <li>Remember me remember_tokens 
                        <br/>
                        CREATE TABLE remember_tokens (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    user_id INT UNSIGNED NOT NULL,

    token_hash VARCHAR(255) NOT NULL,

    expires_at DATETIME NOT NULL,

    created_at DATETIME NULL,

    FOREIGN KEY (user_id)
    REFERENCES users(id)
    ON DELETE CASCADE
);</li>
                    </ul>

                </div>

            </div>

        </div>



        <!-- USERS -->
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingUsers">

                <button 
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseUsers"
                    aria-expanded="false"
                    aria-controls="collapseUsers">

                    👥 Пользователи

                </button>

            </h2>


            <div 
                id="collapseUsers"
                class="accordion-collapse collapse"
                aria-labelledby="headingUsers"
                data-bs-parent="#accordionERP">

                <div class="accordion-body">

                    <ul>
                        <li>users.view</li>
                        <li>users.create</li>
                        <li>users.edit</li>
                        <li>users.delete</li>
                        <li>roles</li>
                    </ul>

                </div>

            </div>

        </div>




        <!-- CARGO -->
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingCargo">

                <button 
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseCargo"
                    aria-expanded="false"
                    aria-controls="collapseCargo">

                    🚚 Cargo

                </button>

            </h2>


            <div 
                id="collapseCargo"
                class="accordion-collapse collapse"
                aria-labelledby="headingCargo"
                data-bs-parent="#accordionERP">


                <div class="accordion-body">

                    <ul>
                        <li>cargo.view</li>
                        <li>cargo.create</li>
                        <li>cargo.edit</li>
                        <li>cargo.delete</li>
                    </ul>

                </div>


            </div>

        </div>




        <!-- WAREHOUSE -->
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingWarehouse">

                <button 
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseWarehouse"
                    aria-expanded="false"
                    aria-controls="collapseWarehouse">

                    🏭 Warehouse

                </button>

            </h2>


            <div 
                id="collapseWarehouse"
                class="accordion-collapse collapse"
                aria-labelledby="headingWarehouse"
                data-bs-parent="#accordionERP">

                <div class="accordion-body">

                    <ul>
                        <li>warehouse.view</li>
                        <li>warehouse.stock</li>
                        <li>warehouse.move</li>
                    </ul>

                </div>

            </div>

        </div>





        <!-- ACCOUNTING -->
        <div class="accordion-item">

            <h2 class="accordion-header" id="headingAccounting">

                <button 
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseAccounting"
                    aria-expanded="false"
                    aria-controls="collapseAccounting">

                    💰 Accounting

                </button>

            </h2>


            <div 
                id="collapseAccounting"
                class="accordion-collapse collapse"
                aria-labelledby="headingAccounting"
                data-bs-parent="#accordionERP">

                <div class="accordion-body">

                    <ul>
                        <li>invoice.view</li>
                        <li>invoice.create</li>
                        <li>invoice.edit</li>
                        <li>invoice.delete</li>
                    </ul>

                </div>

            </div>

        </div>




    </div>


</div>



<!-- Bootstrap 5 JS -->
<script 
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
