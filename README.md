# Media Web Site

## upstream web site template
`git remote add website https://github.com/jeff-puckett/WebSite.git`  
`git fetch website`  
`git checkout template`  
`git pull website template`  
`git checkout master`  
`git merge template master`  

## upstream rsstv plugin
`git remote add rsstv https://github.com/admonkey/rsstv.git`  
`git subtree pull --prefix=TV/rsstv/ rsstv master`  
