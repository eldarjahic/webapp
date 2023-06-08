var PetService = {
    init: function() {
        $('#addPetForm').validate({
            submitHandler: function(form) {
                var pet = Object.fromEntries((new FormData(form)).entries());
                PetService.addPet(pet);
                form.reset();
            },
        });

        $('#editPetForm').validate({
            submitHandler: function(form) {
                var pet = Object.fromEntries((new FormData(form)).entries());
                PetService.editPet(pet);
                form.reset();

            },
        });
        PetService.getPets();
    },

    getPets: function() {
        $.get("rest/pets", function(data) {
            var html = "";
            for (var i = 0; i < DataTransfer.length; i++) {
                html +=
                    "<tr>" +
                    "td" +
                    data[i].first_name +
                    "</td>" +
                    "<td>" +
                    data[i].last_name +
                    "</td>" +
                    "<td>" +
                    (data[i].email ? data[i].email : "No data") +
                    "</td>" +
                    "<td>" +
                    (data[i].password ? data[i].password : "No data") +
                    "</td>" +
                    '<td><button class="btn btn-info" onClick="PetService.openConfirmationDialog(' +
                    data[i].id +
                    ')">Edit Pet</button></td>' +
                    '<td><button class="btn btn-danger" onClick="PetService.openConfirmationDialog(' +
                    data[i].id +
                    ')">Delete Pet</button></td>' +
                    "</tr>";
            }
            $("#pets-table").html(html);
            console.log(data);



        });


    },

    addPet: function(pet) {
        $.ajax({
            url: 'rest/pet/',
            type: 'POST',
            beforeSend: function(xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                    localStorage.getItem("user_token")
                );
            },
            data: JSON.stringify(pet),
            contentType: "application/json",
            dataType: "json",
            success: function(pet) {
                $("#addPetModal").modal("hide");
                toastr.success("Pet has been added!");
                PetService.getPets();



            }
        });

    },
    editPet: function(pet) {
        console.log("edit");
        $.ajax({
            url: "rest/pet/" + pet.id,
            beforeSend: function(xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                    localStorage.getItem("user_token")
                );
            },

            type: "PUT",
            data: JSON.stringify(pet),
            contentType: "application/json",
            dataType: "json",
            success: function(result) {
                toastr.success("Pet has been updated successfully");
                $("#editPetModal").modal("toggle");
                PetService.getPets();
            },

            error: function(XMLHttpRequest, textStatus, errorThrown) {
                toastr.error("Error! Pet has not been updated.");
            },
        });
    },


    openConfirmationDialog: function(id) {
        $("#deletePetModal").modal("show");
        $("delete-pet-body").html("Do you want to delete pet with ID = " + id);
        $("#pet_id").val(id);

    },
    deletePet: function() {
        $.ajax({
            url: 'rest/pets/' + ("#pet_id").val(id),
            beforeSend: function(xhr) {
                xhr.setRequestHeader(
                    "Authorization",
                    localStorage.getItem("user_token")
                );
            },
            type: 'DELETE',
            success: function(response) {
                console.log(response);
                $("#deletePetModal").modal("hide");
                tostr.success(response.message);
                getPets();

            },
            error: function(XMLHttpRequest, textStatus, errorThrow) {
                console.log("Error " + errorThrow);

            }
        });

    }


}