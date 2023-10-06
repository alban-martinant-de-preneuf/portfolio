const projectsSection = document.querySelector('#projects_section');
const nav = document.querySelector('#nav');
const burger = document.querySelector('#burger');
const closeMenu = document.querySelector('#close-menu');

burger.addEventListener('click', () => {
    nav.classList.remove('-translate-x-40');
    nav.classList.add('translate-x-0');
});

closeMenu.addEventListener('click', () => {
    nav.classList.remove('translate-x-0');
    nav.classList.add('-translate-x-40');
});

async function getProjects() {
    const response = await fetch('includes/variables.php?projects=true');
    const projects = await response.json();
    return projects;
}

// function displayProjects(projects) {
//     Object.keys(projects).forEach(project => {
//         const projectDiv = document.createElement('div');
//         projectDiv.classList.add('project_div', 'col-span-1', 'max-w-20');
//         const projectLink = document.createElement('a');
//         projectLink.href = projects[project].url;
//         projectLink.target = '_blank';
//         const projectTitle = document.createElement('h3');
//         projectTitle.classList.add('project_title');
//         projectTitle.innerText = project;
//         const imgDiv = document.createElement('div');
//         imgDiv.classList.add('img_div');
//         const fadedBox = document.createElement('div');
//         fadedBox.classList.add('fadedbox');
//         const description = document.createElement('div');
//         description.classList.add('description');
//         description.innerText = projects[project].description;
//         const img = document.createElement('img');
//         img.src = projects[project].image;
//         img.alt = project;
//         img.classList.add('project_img');
//         const githubLink = document.createElement('a');
//         githubLink.href = projects[project].github;
//         githubLink.target = '_blank';
//         const github = document.createElement('p');
//         github.classList.add('project_github');
//         github.innerText = 'Github';

//         fadedBox.appendChild(description);
//         imgDiv.appendChild(fadedBox);
//         imgDiv.appendChild(img);
//         projectLink.appendChild(projectTitle);
//         projectLink.appendChild(imgDiv);
//         githubLink.appendChild(github);
//         projectDiv.appendChild(projectLink);
//         projectDiv.appendChild(githubLink);
//         projectsSection.appendChild(projectDiv);
//     })
// }

// getProjects().then(projects => {
//     displayProjects(projects);
// });

// const certifSelect = document.querySelector('#certif-select');

// async function getCertifs() {
//     const response = await fetch('includes/variables.php?certificats=true');
//     const certifs = await response.json();
//     return certifs;
// }

// function createOptions(certifs) {
//     Object.keys(certifs).forEach(certif => {
//         const option = document.createElement('option');
//         option.value = certif;
//         option.innerText = certif;
//         certifSelect.appendChild(option);

//         certifSelect.addEventListener('change', (e) => {
//             const targetDiv = document.querySelector('#certif-img');
//             const img = document.createElement('img');
//             img.src = certifs[e.target.value];
//             targetDiv.innerHTML = '';
//             targetDiv.appendChild(img);
//         })
//     })
// }

// getCertifs().then(certifs => {
//     createOptions(certifs);
// });


// height of the hero section

// const header = document.querySelector('header');
// const hero = document.querySelector('#hero');

// const headerHeight = header.offsetHeight;
// const windowHeight = window.innerHeight;
// const heroHeight = windowHeight - headerHeight;

// hero.style.height = `${heroHeight}px`;

// show certif button

const certifBtns = document.querySelectorAll('.certif_btn');
console.log(certifBtns);

certifBtns.forEach(btn => {
    console.log(btn);
    btn.addEventListener('click', (e) => {
        const src = e.target.id;
        const modal = document.querySelector('#modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        modal.querySelector('img').src = "images/Certificats/" + src;

        const closeBtn = modal.querySelector('#close_btn');
        closeBtn.addEventListener('click', () => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        })
    })
});

// send form

const form = document.querySelector('#contact_form');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    fetch('contact.php', {
        method: 'POST',
        body: formData
    }).then(response => {
        if (response.ok) {
            response.json().then(data => {
                const message = document.querySelector('#form-message');
                console.log(data);
                if (data.success) {
                    message.style.color = 'green';
                    message.innerText = data.message;
                    form.reset();
                } else {
                    message.style.color = 'red';
                    message.innerText = data.message;
                };
            })
        }
    }).catch(error => {
        console.log(error);
    })
})


