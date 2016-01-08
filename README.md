# Media Web Site
clone from Jeff Puckett  
adapted for tv, movies, music, media, and more  
`git remote add website https://github.com/jeff-puckett/WebSite.git`  
`git fetch website`  
`git checkout template`  
`git pull website template`  
`git checkout master`  
`git merge template master`  

# rsstv plugin subtree  
`git remote add rsstv https://github.com/admonkey/rsstv.git`  
# pull plugin updates  
`git subtree pull --prefix=TV/rsstv/ rsstv master`