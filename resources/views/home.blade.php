@extends('layouts.main')

@section('content')
<style>
    /* Styling for the drop-down arrow */
    .arrow-icon {
    display: inline-block;
    width: 16px;
    text-align: center;
    margin-right: 10px;
    }

    /* Hide child rows by default */
    .child-row {
    display: none;
    }

    /* Indent the child rows */
    .child-cell {
    padding-left: 30px;
    }
</style>
<!-- Content Start -->
    <div class="content">
        <!-- Navbar Start -->
            @include('layouts.admin_nav')
        <!-- Navbar End -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-secondary text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Salse</h6>
                    <a href="">Show All</a>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th scope="col">ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="parent-row clickable">
                                <td>
                                    <div class="arrow-icon">&#9656;</div>
                                    <div class="parent-cell">1</div>
                                </td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="child-row">
                                 
                                <td>1</td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="child-row">
                                 
                                <td>2</td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="child-row">
                                 
                                <td>3</td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="parent-row clickable">
                                <td>
                                    <div class="arrow-icon">&#9656;</div>
                                    <div class="parent-cell">2</div>
                                </td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="child-row">
                                 
                                <td>1</td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="child-row">
                                 
                                <td>2</td>
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                            <tr class="parent-row clickable">
                                <td>
                                    <div class="arrow-icon">&#9656;</div>
                                    <div class="parent-cell">3</div>
                                </td> 
                                <td>01 Jan 2045</td>
                                <td>INV-0123</td>
                                <td>Jhon Doe</td>
                                <td>$123</td>
                                <td>Paid</td>
                                <td><a class="btn btn-sm btn-primary" href="">Detail</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- Content End -->

@endsection
@section('js')
    <script>
    // Get all parent rows
    const parentRows = document.querySelectorAll('.parent-row');

    // Add click event listeners to parent rows
    parentRows.forEach((parentRow) => {
        parentRow.addEventListener('click', () => {
        // Find the next sibling row of the parent
        const childRow = parentRow.nextElementSibling;

        // Toggle the visibility of the child row
        if (childRow.classList.contains('child-row')) {
            childRow.style.display = childRow.style.display === 'none' ? 'table-row' : 'none';
        }
        });
    });
    </script>
@endsection