/**
 * This file is used to handle WordPress original file
 * */
const fs = require('fs');
const path = require("path");
const { exec } = require('child_process');

/** Find Minified Files Inside Directory */
function findMinifiedFiles(dir, fileList = []) {
	const files = fs.readdirSync(dir);

	files.forEach((file) => {
		const filePath = path.join(dir, file);
		const fileStat = fs.lstatSync(filePath);

		if (fileStat.isDirectory()) {
			findMinifiedFiles(filePath, fileList);
		} else if (/\.min\./.test(file)) {
			fileList.push(filePath);
		}
	});

	return fileList;
}

let originalassets = [
	path.resolve(__dirname, 'assets/build'),
	path.resolve(__dirname, 'assets/vendor')
];

/** Generate Original Assets */
originalassets.map((directoryPath) => {
	// check if directory exists
	if (fs.existsSync(directoryPath)) {
		const MinifiedFiles = findMinifiedFiles(directoryPath)
		MinifiedFiles.map((f) => {
			if(f.includes('.map')) return;
			fs.copyFile(f, f.replace('.min',''), (error) => {
				/** Copy File */
				if (error) {
					console.error(error);
					return;
				}
				let filename = path.basename(f).replace('.min', '');
				console.log(`✅ ${filename} successfully copied!`);

				/** Do Prettier */
				exec(`npx prettier --write "${f.replace('.min','')}"`, (error, stdout, stderr) => {
					if (error) {
						console.error(`exec error: ${error}`);
						return;
					}

					console.log(`stdout: ${stdout}`);
					console.log(`stderr: ${stderr}`);
					console.log(`✅ ${filename} successfully unminified!`);
				});
			});
		})
	}
})
