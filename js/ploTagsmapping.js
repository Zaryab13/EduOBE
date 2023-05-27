const dropdown = document.getElementById("ploDropdown");
        const tagContainer = document.querySelector(".tag-container");

        dropdown.addEventListener("change", function () {
            const selectedOption = dropdown.value;

            if (selectedOption !== "") {
                const selectedText = dropdown.options[dropdown.selectedIndex].text;

                // const addedTags = document.createElement('div');
                // addedTags.classList.add("added-tags");

                const tag = document.createElement("div");
                tag.classList.add("tag");
                tag.textContent = selectedText;

                const removeBtn = document.createElement("span");
                removeBtn.classList.add("tag-remove");
                removeBtn.innerHTML = "&times;";
                removeBtn.addEventListener("click", function () {
                    tagContainer.removeChild(tag);
                    dropdown.options[dropdown.selectedIndex].disabled = false;
                });

                tag.appendChild(removeBtn);
                tagContainer.appendChild(tag);
                // tagContainer.appendChild(addedTags);

                dropdown.options[dropdown.selectedIndex].disabled = true;
                dropdown.selectedIndex = 0;
            }
        });
